<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContributorPermissionResource\Pages;
use App\Filament\Resources\ContributorPermissionResource\RelationManagers;
use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\ContributorPermission;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContributorPermissionResource extends Resource
{
    protected static ?string $model = ContributorPermission::class;

    protected static ?string $navigationIcon = 'heroicon-o-no-symbol';

    // protected static ?string $navigationGroup = 'Content Management - CM -';


    public static function getNavigationGroup(): ?string
    {
        return __('Content Management - CM -');
    }

    public static function getNavigationLabel(): string
    {
        return __('Contributor Permissions');
    }

    public static function getLabel(): ?string
    {
        return __('Contributor Permissions');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Group::make()->schema([

                    Section::make(__('Contributor & Capsule'))
                        ->schema([

                            Select::make('contributor_id')
                                ->relationship('contributor.user', 'name')
                                ->searchable()
                                ->label(__("Contributor"))
                                ->required(),

                            Select::make('capsule_id')
                                ->label(__("On Capsule"))
                                ->relationship('capsule', 'title')
                                ->searchable()
                                ->required(),


                        ])->columns(2),

                ]),

                Group::make()->schema([

                    Section::make(__('Permission'))

                        ->schema([

                            Select::make('permission')
                                ->options([
                                    "r" =>  ucfirst(__("read")),
                                    "w" => ucfirst(__("write"))
                                ])
                                ->label(__("Permission"))
                                ->required(),

                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('permission')
                    ->label(__("Permission"))
                    ->formatStateUsing(function ($record) {
                        if ($record->permission == 'r') {
                            return 'R - Read Only';
                        } else if ($record->permission == 'w') {
                            return 'W - Read & Write';
                        }
                    }),

                Tables\Columns\TextColumn::make('contributor_id')
                    ->label(__("Contributor"))
                    ->formatStateUsing(fn($record) => User::where('id', $record->contributor_id)->first()->name)
                    ->sortable(),

                // TextColumn::make('contributor.user.name')
                //     ->label("Contributor")
                //     // ->formatStateUsing(fn($record) => User::where('id', $record->contributor_id)->first()->name)
                //     ->sortable(),

                Tables\Columns\TextColumn::make('capsule.title')
                    ->label(__("Capsule"))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('Created At'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('Updated At'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->label(__('Deleted At'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                Tables\Filters\TrashedFilter::make(),

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
            'index' => Pages\ListContributorPermissions::route('/'),
            'create' => Pages\CreateContributorPermission::route('/create'),
            'view' => Pages\ViewContributorPermission::route('/{record}'),
            'edit' => Pages\EditContributorPermission::route('/{record}/edit'),
        ];
    }
}
