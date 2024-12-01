<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CapsuleResource\Pages;
use App\Filament\Resources\CapsuleResource\RelationManagers;
use App\Models\Capsule;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CapsuleResource extends Resource
{
    protected static ?string $model = Capsule::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getNavigationGroup(): ?string
    {
        return __('Content Management - CM -');
    }

    public static function getNavigationLabel(): string
    {
        return __('Capsules');
    }

    public static function getLabel(): ?string
    {
        return __('Capsules');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Capsule')
                    ->label('Name & Contributors')
                    ->schema([

                        Forms\Components\TextInput::make('title')
                            ->label(__('Capsule Title'))
                            ->required(),

                        Select::make('user_id')
                            ->relationship('owner', 'name')
                            ->label(__('Owner'))
                            ->searchable()
                            ->required(),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Capsule Title')),

                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('Owner')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCapsules::route('/'),
            'create' => Pages\CreateCapsule::route('/create'),
            'edit' => Pages\EditCapsule::route('/{record}/edit'),
        ];
    }
}
