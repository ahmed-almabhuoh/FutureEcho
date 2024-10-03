<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RolePermissionResource\Pages;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolePermissionResource extends Resource
{
    protected static ?string $model = RolePermission::class;

    protected static ?string $label = 'Assign Permissions';

    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    protected static ?string $navigationGroup = 'Roles & Permissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Assign Permissions')
                    ->schema([
                        Select::make('role_id')
                            ->label('Role')
                            ->relationship('role', 'role_en') // Assuming 'role_en' is the field used for Role name
                            ->required()
                            ->searchable(),

                        Select::make('permission_id')
                            ->label('Permission')
                            ->relationship('permission', 'name_en') // Assuming 'name_en' is the field used for Permission name
                            ->required()
                            ->searchable(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('role.role_en')
                    ->label('Role')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('permission.name_en')
                    ->label('Permission')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('assigned_at')
                    ->label('Assigned At')
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
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\EditAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relationship managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRolePermissions::route('/'),
            'create' => Pages\CreateRolePermission::route('/create'),
            'edit' => Pages\EditRolePermission::route('/{record}/edit'),
        ];
    }
}
