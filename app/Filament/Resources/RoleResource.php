<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Permission;
use App\Models\Role;
use App\Models\UserGroup;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    // protected static ?string $navigationGroup = 'Roles & Permissions';

    public static function getNavigationGroup(): ?string
    {
        return __('Roles & Permissions');
    }

    public static function getNavigationLabel(): string
    {
        return __('Roles');
    }

    public static function getLabel(): ?string
    {
        return __('Roles');
    }

    public static function canCreate(): bool
    {
        return checkAuthority('create-role');
    }

    public static function canEdit(Model $record): bool
    {
        return checkAuthority('edit-role');
    }

    public static function canDelete(Model $record): bool
    {
        return checkAuthority('delete-role');
    }

    public static function canViewAny(): bool
    {
        return checkAuthority('read-roles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Details'))->schema([

                    TextInput::make('role_ar')
                        ->label(__('Arabic Name'))
                        ->required()
                        ->minValue(2)
                        ->maxValue(191)
                        ->maxLength(191),

                    TextInput::make('role_en')
                        ->label(__('English Name'))
                        ->required()
                        ->minValue(2)
                        ->maxValue(191)
                        ->maxLength(191),

                    Select::make('user_group_id')
                        ->label(__('User Group'))
                        // ->options([])
                        // ->options(UserGroup::select(['name_en', 'id'])->get()->pluck('name_en', 'id')->toArray())
                        ->relationship('userGroup', 'name_en')
                        ->searchable()
                        // ->options(config('app.locale') == 'en' ? UserGroup::select(['name_en', 'id'])->get()->pluck('name_en', 'id')->toArray() : UserGroup::select(['name_en', 'id'])->get()->pluck('name_ar', 'id')->toArray())
                        ->required()
                        ->columnSpan('full'),

                ])->columns(2),


                // Section::make(__('Group & Permissions'))->schema([

                //     ,

                //     // Select::make('rolePermissions.permission_id')
                //     //     ->label(__('Permissions'))
                //     //     // ->options(Permission::select(['name_en', 'id'])->get()->pluck('name_en', 'id')->toArray())
                //     //     ->relationship('rolePermissions.permissions', 'name_en')
                //     //     ->multiple()
                //     //     ->searchable()
                //     //     ->required(),

                // ])->columns(2),

                Section::make(__('Visibility'))->schema([

                    Select::make('status')
                        ->label(__('Status'))
                        ->options([
                            'active' => __('Active'),
                            'inactive' => __('Inactive'),
                        ])
                        ->required(),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('role_ar')
                    ->label(__('Arabic Name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('role_en')
                    ->label(__('English Name'))
                    ->sortable()
                    ->searchable(),

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

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Deleted At')
                    ->dateTime()
                    ->sortable()
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

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
                    ->label(__('Delete actions'))
                    ->color('danger')
                    ->button(),

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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
