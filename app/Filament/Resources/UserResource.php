<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Section;
use App\Enum\UserStatus;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use App\Notifications\AdvertisementNotification;
use App\Notifications\ChangeUserPasswordNotification;
use App\Notifications\ResendTwoFANotification;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\Ternary;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
use PhpParser\Node\Stmt\Label;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    // protected static ?string $navigationGroup = 'Human Resources - HR -';

    public static function getNavigationGroup(): ?string
    {
        return __('Human Resources - HR -');
    }

    public static function getNavigationLabel(): string
    {
        return __('Users');
    }

    public static function getLabel(): ?string
    {
        return __('Users');
    }

    public static function canCreate(): bool
    {
        return checkAuthority('create-user');
    }

    public static function canEdit(Model $record): bool
    {
        return checkAuthority('edit-user');
    }

    public static function canDelete(Model $record): bool
    {
        return checkAuthority('delete-user');
    }

    public static function canViewAny(): bool
    {
        return checkAuthority('read-users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Group::make()->schema([

                    Section::make(__('General Info'))->schema([

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('User - Full name'))
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique()
                            ->maxLength(255)
                            ->email()
                            // ->unique(User::class, modifyRuleUsing: function (Unique $rule) {
                            //     return $rule->where('is_active', 1);
                            // })
                            ->label(__('E-mail')),

                        Forms\Components\TextInput::make('phone')
                            ->label(__('Phone NO.'))
                            ->helperText(__('NO. for Number'))
                            ->minValue(7)
                            ->maxValue(25),

                        Select::make('status')->options([
                            'active' => ucfirst(__(UserStatus::ACTIVE->value)),
                            'inactive' => ucfirst(__(UserStatus::INACTIVE->value)),
                        ])
                            ->columnSpanFull()
                            ->required()
                            ->label(__('Status'))
                            ->in(['active', 'inactive']),

                    ])
                        ->collapsible()
                        ->columns(2),

                ])->columns(2),

                Group::make()->schema([

                    Section::make(__("Account Settings"))->schema([

                        DateTimePicker::make('email_verified_at')
                            ->label(__('Email verified at')),

                        Select::make('timezone')
                            ->options(config('timezones'))
                            ->default('UTC')
                            ->label(__('TimeZone'))
                            ->helperText(__('Account language & time will set up depending on timezone.'))
                            ->required()
                            ->searchable(),

                        TextInput::make('password')
                            ->password()
                            ->label(__('Password'))
                            ->minValue(8)
                            ->maxValue(191)
                            // ->default(Str::random(10))
                            ->disabledOn('edit')
                            ->columnSpanFull(),

                        Toggle::make('is_admin')
                            ->label(__('Admin'))
                            ->required()
                            ->helperText(__('Admin users will have full permissions!'))
                            ->default(false),

                    ])
                        ->collapsible()
                        ->columns(2),
                ]),

                Group::make()->schema([

                    Section::make(__('Media & Attachments'))->schema([

                        FileUpload::make('image')
                            ->image()
                            ->label(__('Image'))
                            ->directory('users')
                            ->imageEditor()
                            ->previewable()
                            ->nullable(),

                    ])->columnSpan('full'),

                    // Section::make(__('Authority'))->schema([

                    //     // Select::make('roles')->options(
                    //     //     config('app.locale') == 'en' ? Role::select(['id', 'role_en'])->get()->pluck('role_en', 'id')->toArray() : Role::select(['id', 'role_ar'])->get()->pluck('role_ar', 'id')->toArray()
                    //     // )
                    //     //     ->searchable()
                    //     //     ->columnSpanFull()
                    //     //     ->multiple()
                    //     //     // ->required()
                    //     //     // ->in(Role::select(['id'])->get()->pluck('id')->toArray())
                    //     //     ->label(__('Role')),

                    // ])->columnSpan('full'),

                ])->columnSpanFull(),
            ]);
    }

    // protected static function mutateFormDataBeforeSave(array $data): array
    // {
    //     if (isset($data['password'])) {
    //         $data['password'] = Hash::make($data['password']);
    //     }
    //     return $data;
    // }

    protected function afterCreated () : void {
        info('here');
    }

    // public static function afterSave(Form $form): void
    // {
    //     $user = $form->record; // Get the saved user instance
    //     $roles = $form->data['roles'] ?? []; // Get selected roles
    //     $user->roles()->sync($roles); // Sync roles with the user
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),

                ImageColumn::make('image')
                    ->label(__('Image')),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('E-mail'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('Phone'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('timezone')
                    ->label(__('Timezone'))
                    ->searchable(),

                BooleanColumn::make('is_admin')
                    ->label(__('Admin'))
                    ->colors([
                        'success' => 1,
                        'danger' => 0,
                    ]),

                IconColumn::make('status')
                    ->label(__('Status'))
                    ->options([
                        'heroicon-o-check-circle' => 'active',
                        'heroicon-o-x-circle' => 'inactive',
                    ])
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ])
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label(__('Verified At'))
                    ->dateTime()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('Deleted At'))
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
                SelectFilter::make('status')
                    ->options([
                        'active' => __('Active'),
                        'inactive' => __('Inactive'),
                    ])
                    ->label(__('Status')),

                Tables\Filters\TrashedFilter::make(),

                TernaryFilter::make('is_admin')->label(__('Admin')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
                    ->label(__('Delete actions'))
                    ->color('danger')
                    ->button(),

                Tables\Actions\ActionGroup::make([

                    Tables\Actions\Action::make(__('Change Password'))
                        ->action(function ($record): void {
                            // Change password logic here
                            $record->notify(new ChangeUserPasswordNotification($record->name, generateToken($record->id)));

                            Notification::make()
                                ->title(__('Sent Successfully'))
                                ->success()
                                ->send();
                        })
                        ->icon('heroicon-m-lock-closed')
                        ->label(__('Recover Password'))
                        ->color('warning')
                        ->requiresConfirmation(),

                    Tables\Actions\Action::make(__('Re-Send 2FA'))
                        ->action(function ($record): void {
                            $record->notify(new ResendTwoFANotification($record->name, generate2FA($record->id)));

                            Notification::make()
                                ->title(__('Sent Successfully'))
                                ->success()
                                ->send();
                        })
                        ->icon('heroicon-m-hashtag')
                        ->label(__('Recover Password'))
                        ->color('danger')
                        ->requiresConfirmation(),
                ])
                    ->label(__('Authentication'))
                    ->color('primary')
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                ]),

                BulkAction::make(__('Send Advertisement'))
                    ->form([
                        Forms\Components\Textarea::make('advertisement_text')
                            ->label(__('Advertisement Text'))
                            ->required()
                            ->placeholder(__('Enter the advertisement text here...'))
                    ])
                    ->action(function ($records, array $data): void {
                        $advertisementText = $data['advertisement_text'];

                        foreach ($records as $user) {
                            $user->notify(new AdvertisementNotification($advertisementText, $user->name));
                        }

                        Notification::make()
                            ->title(__('Sent Successfully'))
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
