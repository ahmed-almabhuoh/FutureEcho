<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContributorPermissionResource\Pages;
use App\Filament\Resources\ContributorPermissionResource\RelationManagers;
use App\Models\Capsule;
use App\Models\ContributorPermission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContributorPermissionResource extends Resource
{
    protected static ?string $model = ContributorPermission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('permission')->options([
                  "r"=>__("read"),
                   "w"=>__("write")
                ])->label("permission")
                    ->required(),
                Forms\Components\Select::make('contributor_id')->
                relationship('contributor.user','name')->label("Name")
                    ->required(),
                    
                Forms\Components\Select::make('capsule_id')->label("title")
                ->relationship('capsule','title')
                
                    ->required()
                   ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('permission')->label("permission"),
                Tables\Columns\TextColumn::make('contributor.user.name')->label("Name")
                    
                    ->sortable(),
                Tables\Columns\TextColumn::make('capsule.title')
                ->label("title")
                    ->sortable(),
               Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListContributorPermissions::route('/'),
            'create' => Pages\CreateContributorPermission::route('/create'),
            'view' => Pages\ViewContributorPermission::route('/{record}'),
            'edit' => Pages\EditContributorPermission::route('/{record}/edit'),
        ];
    }
}
