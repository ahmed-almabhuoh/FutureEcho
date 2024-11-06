<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationGroup = 'Roles & Permissions';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-no-symbol';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([

                Section::make('Details')->schema([
                    TextInput::make('name_ar')
                        ->label('Arabic Name')
                        ->required()
                        ->minValue(2)
                        ->maxValue(191)
                        ->maxLength(191),

                    TextInput::make('name_en')
                        ->label('English Name')
                        ->required()
                        ->minValue(2)
                        ->maxValue(191)
                        ->maxLength(191),
                ])->columns(2),

                Section::make('Visibility')->schema([
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'active' => __('Active'),
                            'inactive' => __('Inactive'),
                        ])
                        ->required(),
                ]),

                Section::make('Associated With')->schema([
                    Select::make('user_group')
                        ->label('User Group')
                        ->relationship('userGroup', 'name_en')
                        ->searchable()
                        ->required()
                        ->exists('user_groups', 'id'),
                ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name_ar')
                    ->label('Arabic Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name_en')
                    ->label('English Name')
                    ->sortable()
                    ->searchable(),

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

                TextColumn::make('userGroup.name_en')
                    ->label('User Group')
                    ->sortable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->label('Status'),

                Tables\Filters\TrashedFilter::make(),
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
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relationships if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
