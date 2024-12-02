<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserRoleResource\Pages;
use App\Filament\Resources\UserRoleResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserRoleResource extends Resource
{
    protected static ?string $model = UserRole::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Roles & Permissions');
    }

    public static function getNavigationLabel(): string
    {
        return __('User Roles');
    }

    public static function getLabel(): ?string
    {
        return __('User Roles');
    }

    public static function canCreate(): bool
    {
        return checkAuthority('create-user-role');
    }

    public static function canEdit(Model $record): bool
    {
        return checkAuthority('edit-user-role');
    }

    public static function canDelete(Model $record): bool
    {
        return checkAuthority('delete-user-role');
    }

    public static function canViewAny(): bool
    {
        return checkAuthority('read-user-roles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Group::make()
                    ->schema([

                        Section::make(__('User Roles'))
                            ->schema([

                                Select::make('user_id')
                                    ->label(__('User'))
                                    ->options(User::select(['name', 'id'])->get()->pluck('name', 'id')->toArray())
                                    ->required()
                                    // ->in(User::select(['id', 'name'])->get()->mapWithKeys(function ($record) {
                                    //     return [$record->id => $record->name];
                                    // })->toArray())
                                    ->searchable(),

                                Select::make('role_id')
                                    ->label(__('Roles'))
                                    ->options(config('app.locale') == 'en' ? Role::select(['role_en', 'id'])->get()->pluck('role_en', 'id')->toArray() : Role::select(['role_ar', 'id'])->get()->pluck('role_ar', 'id')->toArray())
                                    // ->relationship('role', 'role_en')
                                    ->required()
                                    // ->in(Role::select(['id', 'role_en'])->get()->mapWithKeys(function ($record) {
                                    //     return [$record->id => $record->role_en];
                                    // })->toArray())
                                    // ->multiple()
                                    ->searchable(),

                                DateTimePicker::make('assigned_at')
                                    ->label(__('Assigned At'))
                                    ->default(now())
                                    ->disabled(true)
                                    ->columnSpan('full'),

                            ])->columns(2),

                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                TextColumn::make('user.name')
                    ->label(__('User'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make(config('app.locale') == 'en' ? 'role.role_en' : 'role.role_ar')
                    ->label(__('Role'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('assigned_at')
                    ->label(__('Assigned At'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUserRoles::route('/'),
            'create' => Pages\CreateUserRole::route('/create'),
            'edit' => Pages\EditUserRole::route('/{record}/edit'),
        ];
    }
}
