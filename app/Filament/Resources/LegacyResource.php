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

    // protected static ?string $navigationGroup = 'Human Resources - HR -';

    // protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('Human Resources - HR -');
    }

    public static function getNavigationLabel(): string
    {
        return __('Legacies');
    }

    public static function getLabel(): ?string
    {
        return __('Legacy');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Group::make()->schema([

                    Section::make(__('Legacy Related Details'))->schema([

                        Select::make('user_id')
                            ->label(__('For User'))
                            ->relationship('user', 'name')
                            ->required()
                            ->exists('users', 'id')
                            ->searchable(),

                        TextInput::make('email')
                            ->label(__('Legacy'))
                            ->required()
                            ->exists('users', 'email'),

                        Select::make('status')
                            ->label(__('Status'))
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
                    ->label(__('User'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label(__('Legacy'))
                    ->sortable()
                    ->searchable(),

                BadgeColumn::make('status')
                    ->label(__('Status'))
                    ->colors([
                        'primary' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                    ])
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created At')
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
            'index' => Pages\ListLegacies::route('/'),
            'create' => Pages\CreateLegacy::route('/create'),
            'edit' => Pages\EditLegacy::route('/{record}/edit'),
        ];
    }
}
