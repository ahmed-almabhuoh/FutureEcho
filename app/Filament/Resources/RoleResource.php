<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Forms;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Details')->schema([
                    TextInput::make('role_ar')
                        ->label('Arabic  Role')
                        ->required()
                        ->minValue(2)
                        ->maxValue(191)
                        ->maxLength(191),

                    TextInput::make('role_en')
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
    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn ::make('role_ar')
                ->label('Arabic Role')
                ->sortable()
                ->searchable(),

            TextColumn::make('role_en')
                ->label('English Role')
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
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
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
