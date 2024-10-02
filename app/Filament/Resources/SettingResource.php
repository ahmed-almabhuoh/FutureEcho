<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationGroup = 'Website Configuration';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    public static function canCreate(): bool
    {
        return ! Setting::count() == 1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Settings')->schema([
                    FileUpload::make('logo')
                        ->label('Logo')
                        ->required()
                        ->disk('public')
                        ->directory('logos')
                        ->image()
                        ->maxSize(1024)
                        ->enableOpen()
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('sign_up')
                        ->label('Enable Sign Up')
                        ->onIcon('heroicon-m-bolt')
                        ->offIcon('heroicon-m-user')
                        ->default(true)
                        ->required(),

                    Forms\Components\Toggle::make('sign_in')
                        ->label('Enable Login')
                        ->onIcon('heroicon-m-bolt')
                        ->offIcon('heroicon-m-user')
                        ->default(true)
                        ->required()
                        ->reactive(),
                    Forms\Components\Toggle::make('maintenance')
                        ->label('Maintenance Mode')
                        ->onIcon('heroicon-m-bolt')
                        ->default(true)
                        ->required(),
                    //
                ])


            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo'),

                Tables\Columns\ToggleColumn::make('sign_up')
                    ->label('Sign up'),

                Tables\Columns\ToggleColumn::make('sign_in')
                    ->label('Login'),

                Tables\Columns\ToggleColumn::make('maintenance')
                    ->label('Maintenance Mode'),
                //
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
