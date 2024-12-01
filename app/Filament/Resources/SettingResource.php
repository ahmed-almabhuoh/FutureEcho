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

    // protected static ?string $navigationGroup = 'Website Configuration';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    public static function getNavigationGroup(): ?string
    {
        return __('Website Configuration');
    }

    public static function getNavigationLabel(): string
    {
        return __('Configuration');
    }

    public static function getLabel(): ?string
    {
        return __('Configuration');
    }

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
                        ->label(__('Logo'))
                        ->required()
                        ->disk('public')
                        ->directory('logos')
                        ->image()
                        ->maxSize(50000)
                        ->enableOpen()
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('sign_up')
                        ->label(__('Enable Sign Up'))
                        ->onIcon('heroicon-m-bolt')
                        ->offIcon('heroicon-m-user')
                        ->default(true)
                        ->required(),

                    Forms\Components\Toggle::make('sign_in')
                        ->label(__('Enable Login'))
                        ->onIcon('heroicon-m-bolt')
                        ->offIcon('heroicon-m-user')
                        ->default(true)
                        ->required()
                        ->reactive(),
                    Forms\Components\Toggle::make('maintenance')
                        ->label(__('Maintenance Mode'))
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
                Tables\Columns\ImageColumn::make('logo')
                ->label('Logo'),

                Tables\Columns\ToggleColumn::make('sign_up')
                    ->label(__('Sign up')),

                Tables\Columns\ToggleColumn::make('sign_in')
                    ->label(__('Login')),

                Tables\Columns\ToggleColumn::make('maintenance')
                    ->label(__('Maintenance Mode')),
                //
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
