<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LegacyResource\Pages;
use App\Filament\Resources\LegacyResource\RelationManagers;
use App\Models\Legacy;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LegacyResource extends Resource
{
    protected static ?string $model = Legacy::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-left';

    protected static ?string $navigationGroup = 'Human Resources - HR -';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Group::make()->schema([

                    Section::make('Legacy Related Details')->schema([

                        Select::make('user_id')
                            ->label('For User')
                            ->relationship('user', 'name')
                            ->required()
                            ->exists('users', 'id')
                            ->searchable(),

                        TextInput::make('email')
                            ->label('Legacy')
                            ->required()
                            ->exists('users', 'email'),

                        Select::make('status')
                            ->disabled()
                            ->options([
                                'pending' => __('Pending'),
                                'accepted' => __('Accepted'),
                                'rejected' => __('Rejected'),
                            ])
                            ->default('pending')
                            ->required()
                            ->in(['pending', 'accepted', 'rejected'])
                            ->columnSpanFull(),

                    ])->columns(2),

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Legacy')
                    ->sortable()
                    ->searchable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                    ])
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLegacies::route('/'),
            'create' => Pages\CreateLegacy::route('/create'),
            'edit' => Pages\EditLegacy::route('/{record}/edit'),
        ];
    }
}
