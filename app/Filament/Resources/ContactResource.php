<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\View\Components\Modal;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    // public static function canCreate(): bool
    // {
    //     return checkAuthority('create-capsule');
    // }

    public static function canEdit(Model $record): bool
    {
        return checkAuthority('edit-contact-request');
    }

    public static function canDelete(Model $record): bool
    {
        return checkAuthority('delete-contact-request');
    }

    public static function canViewAny(): bool
    {
        return checkAuthority('read-contact-requests');
    }


    public static function getNavigationGroup(): ?string
    {
        return __('Website Configuration');
    }

    public static function getNavigationLabel(): string
    {
        return __('Contact Requests');
    }

    public static function getLabel(): ?string
    {
        return __('Contact Requests');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make(__('Details'))->schema([

                    Forms\Components\TextInput::make(__('name'))->disabled()
                        ->required()
                        ->maxLength(191)
                        ->disabled(),

                    Forms\Components\TextInput::make(__('email'))->disabled()
                        ->email()
                        ->required()
                        ->maxLength(191)
                        ->disabled(),

                    Textarea::make(__('message'))->disabled()
                        ->required()
                        ->disabled()
                        ->maxLength(191)
                        ->columnSpanFull(),

                ])->columns(2),

                Section::make(__('Visibility'))->schema([

                    Select::make('STATUS')
                        ->label(__('Status'))
                        ->options([
                            'submitted' => __('Submitted'),
                            'viewed' => __('Viewed'),
                            'rejected' => __('Rejected'),
                        ])
                        ->required(),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('E-mail'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('Message'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('STATUS')
                    ->label(__('Status')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    // public static function canEdit(Model $record): bool
    // {
    //     return true;
    // }
}
