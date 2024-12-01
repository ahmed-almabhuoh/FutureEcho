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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContributorResource extends Resource
{
    protected static ?string $model = Contributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    // protected static ?string $navigationGroup = 'Content Management - CM -';

    public static function getNavigationGroup(): ?string
    {
        return __('Content Management - CM -');
    }

    public static function getNavigationLabel(): string
    {
        return __('Contributors');
    }

    public static function getLabel(): ?string
    {
        return __('Contributors');
    }

    public static function canCreate(): bool
    {
        return checkAuthority('create-contributor');
    }

    public static function canEdit(Model $record): bool
    {
        return checkAuthority('edit-contributor');
    }

    public static function canDelete(Model $record): bool
    {
        return checkAuthority('delete-contributor');
    }

    public static function canViewAny(): bool
    {
        return checkAuthority('read-contributors');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Create Contributor'))
                    ->schema([

                        Forms\Components\Select::make('capsule_id') // Correct the key here
                            ->relationship('capsule', 'title')
                            ->label(__('Capsule'))
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label(__('Contributor'))
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
                    ->label(__('Contributor')),
                Tables\Columns\TextColumn::make('capsule.title')
                    ->label(__('Capsule')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
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
            'index' => Pages\ListContributors::route('/'),
            'create' => Pages\CreateContributor::route('/create'),
            'edit' => Pages\EditContributor::route('/{record}/edit'),
        ];
    }
}
