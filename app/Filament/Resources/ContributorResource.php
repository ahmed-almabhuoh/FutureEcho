<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContributorResource\Pages;
use App\Filament\Resources\ContributorResource\RelationManagers;
use App\Models\Contributor;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContributorResource extends Resource
{
    protected static ?string $model = Contributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationGroup = 'Content Management - CM -';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create Contributor')
                    ->schema([

                        Forms\Components\Select::make('capsule_id') // Correct the key here
                            ->relationship('capsule', 'title')
                            ->label('Capsule')
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Contributor')
                            ->searchable()
                            ->required(),

                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Contributor'),
                Tables\Columns\TextColumn::make('capsule.title')
                    ->label('Capsule'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
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
            'index' => Pages\ListContributors::route('/'),
            'create' => Pages\CreateContributor::route('/create'),
            'edit' => Pages\EditContributor::route('/{record}/edit'),
        ];
    }
}
