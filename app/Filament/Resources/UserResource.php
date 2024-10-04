<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Section;
use App\Enum\UserStatus;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Notifications\AdvertisementNotification;
use App\Notifications\ChangeUserPasswordNotification;
use App\Notifications\ResendTwoFANotification;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\Ternary;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Human Resources - HR -';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Group::make()->schema([

                    Section::make('General Info')->schema([

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('User - Full name')
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
                            ->label('E-mail'),

                        Forms\Components\TextInput::make('phone')
                            ->label('Phone NO.')
                            ->helperText('NO. for Number')
                            ->minValue(7)
                            ->maxValue(25),

                        Select::make('status')->options([
                            'active' => ucfirst(__(UserStatus::ACTIVE->value)),
                            'inactive' => ucfirst(__(UserStatus::INACTIVE->value)),
                        ])
                            ->columnSpanFull()
                            ->required()
                            ->in(['active', 'inactive']),

                    ])
                        ->collapsible()
                        ->columns(2),

                ])->columns(2),

                Group::make()->schema([

                    Section::make("Account Settings")->schema([

                        DateTimePicker::make('email_verified_at'),

                        Select::make('timezone')
                            ->options(config('timezones'))
                            ->default('UTC')
                            ->label('TimeZone')
                            ->helperText('Account language & time will set up depending on timezone.')
                            ->required()
                            ->searchable(),

                        // TextInput::make('password')
                        //     ->password()
                        //     ->minValue(8)
                        //     ->maxValue(191)
                        //     // ->default(Str::random(10))
                        //     ->columnSpanFull(),

                        Toggle::make('is_admin')
                            ->label('Admin')
                            ->required()
                            ->helperText('Admin users will have full permissions!')
                            ->default(false),

                    ])
                        ->collapsible()
                        ->columns(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('timezone')
                    ->searchable(),

                BooleanColumn::make('is_admin')->colors([
                    'success' => 1,
                    'danger' => 0,
                ]),

                IconColumn::make('status')
                    ->label('Status')
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
                    ->dateTime()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->label('Status'),

                Tables\Filters\TrashedFilter::make(),

                TernaryFilter::make('is_admin')->label('Admin'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
                    ->label('Delete actions')
                    ->color('danger')
                    ->button(),

                Tables\Actions\ActionGroup::make([

                    Tables\Actions\Action::make('Change Password')
                        ->action(function ($record): void {
                            // Change password logic here
                            $record->notify(new ChangeUserPasswordNotification($record->name, generateToken($record->id)));

                            Notification::make()
                                ->title('Sent Successfully')
                                ->success()
                                ->send();
                        })
                        ->icon('heroicon-m-lock-closed')
                        ->label('Recover Password')
                        ->color('warning')
                        ->requiresConfirmation(),

                    Tables\Actions\Action::make('Re-Send 2FA')
                        ->action(function ($record): void {
                            $record->notify(new ResendTwoFANotification($record->name, generate2FA($record->id)));

                            Notification::make()
                                ->title('Sent Successfully')
                                ->success()
                                ->send();
                        })
                        ->icon('heroicon-m-hashtag')
                        ->label('Recover Password')
                        ->color('danger')
                        ->requiresConfirmation(),
                ])
                    ->label('Authentication')
                    ->color('primary')
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                ]),

                BulkAction::make('Send Advertisement')
                    ->form([
                        Forms\Components\Textarea::make('advertisement_text')
                            ->label('Advertisement Text')
                            ->required()
                            ->placeholder('Enter the advertisement text here...')
                    ])
                    ->action(function ($records, array $data): void {
                        $advertisementText = $data['advertisement_text'];

                        foreach ($records as $user) {
                            $user->notify(new AdvertisementNotification($advertisementText, $user->name));
                        }

                        Notification::make()
                            ->title('Sent Successfully')
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
