<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserGroupResource\Pages;
use App\Models\UserGroup;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class UserGroupResource extends Resource
{
    protected static ?string $model = UserGroup::class;

    // protected static ?string $navigationGroup = 'Roles & Permissions';
    public static function getNavigationGroup(): ?string
    {
        return __('Roles & Permissions');
    }

    public static function getNavigationLabel(): string
    {
        return __('User Groups');
    }

    public static function getLabel(): ?string
    {
        return __('User Groups');
    }

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([

                Section::make(__('Details'))->schema([
                    TextInput::make('name_ar')
                        ->label(__('Arabic Name'))
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(191),

                    TextInput::make('name_en')
                        ->label(__('English Name'))
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(191),
                ])->columns(2),

                Section::make(__('Visibility'))->schema([

                    Select::make('status')
                        ->label(__('Status'))
                        ->options([
                            'active' => __('Active'),
                            'inactive' => __('Inactive'),
                        ])
                        ->required()
                        ->in(['active', 'inactive'])
                        ->helperText(__('Inactive user group won\'t be shown or used.')),

                ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name_ar')
                    ->label(__('Arabic Name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name_en')
                    ->label(__('English Name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('status')
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

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->label('Deleted At')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => __('Active'),
                        'inactive' => __('Inactive'),
                    ])
                    ->label(__('Status')),

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
                    ->label(__('Delete actions'))
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
            // Define relationships if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserGroups::route('/'),
            'create' => Pages\CreateUserGroup::route('/create'),
            'edit' => Pages\EditUserGroup::route('/{record}/edit'),
        ];
    }
}
