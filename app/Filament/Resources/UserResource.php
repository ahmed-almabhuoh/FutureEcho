<?php

namespace App\Filament\Resources;
use Filament\Forms\Components\Section;
use App\Enum\UserStatus;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\Ternary;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Section::make('User Information')->schema([

                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)->label('Name'),
                Forms\Components\TextInput::make('email')
                ->email()
                ->required()->unique()
                ->maxLength(255)->label('Email'),

                Forms\Components\TextInput::make('phone')
                ->required()
                ->maxLength(255),
                Select::make('timezone')->options(config('timezones'))->default('UTC')->label('TimeZone')
                    ->required(),])->collapsible(),

                Section::make("Setting")->schema([

                    Forms\Components\DateTimePicker::make('email_verified_at'),
                    Toggle::make('is_admin')->label('Admin')->required()->helperText('Enable or disbale Admin Visibility')->default(true),
                    Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),

                ])->collapsible(),


               Section::make('Status')->schema([

                Select ::make('status')->options([
                    'active'=> UserStatus::ACTIVE->value   ,
                    'inactive'=>UserStatus ::INACTIVE->value   ,

                ]),

               ])->columns(4)







            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('timezone')
                    ->searchable(),
                   BooleanColumn ::make('is_admin') ->colors([
                        'success' => 1,
                        'danger' => 0,
                    ]),
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

            Tables\Columns\TextColumn::make('email_verified_at')
                ->dateTime()
                ->sortable()->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                ->dateTime()
                ->sortable()
                ->searchable()
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
            TernaryFilter ::make('is_admin')->label('Admin'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
