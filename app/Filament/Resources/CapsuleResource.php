<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CapsuleResource\Pages;
use App\Filament\Resources\CapsuleResource\RelationManagers;
use App\Models\Capsule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CapsuleResource extends Resource
{
    protected static ?string $model = Capsule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                // ->maxLength(255),
                // Forms\Components\Select::make('user_id')
                //     ->relationship('users', 'name')
                //     ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
