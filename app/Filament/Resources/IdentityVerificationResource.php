<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IdentityVerificationResource\Pages;
use App\Filament\Resources\IdentityVerificationResource\RelationManagers;
use App\Models\IdentityVerification;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IdentityVerificationResource extends Resource
{
    protected static ?string $model = IdentityVerification::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    // protected static ?string $navigationGroup = 'Content Management - CM -';

    public static function getNavigationGroup(): ?string
    {
        return __('Content Management - CM -');
    }

    public static function getNavigationLabel(): string
    {
        return __('Identity VEF. REQs');
    }

    public static function getLabel(): ?string
    {
        return __('Verification Requests');
    }

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make(__('Identity Verification'))
                    ->description(__('User Identity Verification'))
                    ->schema([
                        Select::make('user_id')
                            ->label(__('User'))
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Select::make('status')
                            ->label(__('Status'))
                            ->options([
                                'pending' => __('Pending'),
                                'verified' => __('Verified'),
                                'rejected' => __('Rejected'),
                            ])->default('pending')
                            ->required(),

                        DateTimePicker::make('submitted_at')
                            ->label(__('Submission Date'))
                            ->default(now())
                            ->disabled()
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('file')
                            ->label(__('File/Image'))->required()->columnSpanFull(),



                    ])->columns(2)

                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('User'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable(),

                TextColumn::make('submitted_at')
                    ->label(__('Submitted At'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),


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
            'index' => Pages\ListIdentityVerifications::route('/'),
            'create' => Pages\CreateIdentityVerification::route('/create'),
            'edit' => Pages\EditIdentityVerification::route('/{record}/edit'),
        ];
    }
}
