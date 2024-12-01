<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResetVerifiedPasswordComponentResource\Pages;
use App\Models\ResetVerifiedCredentials;
use App\Models\User;
use App\Notifications\RestoreVerifiedAccountCredentialsNotification;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;

class ResetVerifiedPasswordComponentResource extends Resource
{
    protected static ?string $model = ResetVerifiedCredentials::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    // protected static ?string $navigationGroup = 'Content Management - CM -';

    public static function getNavigationGroup(): ?string
    {
        return __('Human Resources - HR -');
    }

    public static function getNavigationLabel(): string
    {
        return __('Reset Password REQ.');
    }

    public static function getLabel(): ?string
    {
        return __('Reset Password REQ.');
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('ID'))->sortable(),
                TextColumn::make('name')->label(__('Name'))->searchable(),
                TextColumn::make('email')->label(__('Email'))->searchable(),
                TextColumn::make('status')->label(__('Status'))->sortable(),
                ImageColumn::make('file')->label(__('Image')),
                TextColumn::make('created_at')->label(__('Created At'))->date(),
            ])
            ->actions([
                Tables\Actions\Action::make('notifyUser')
                    ->label(__('Verify and Notify User'))
                    ->form([
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->email(),
                        Forms\Components\Select::make('status')
                            ->label(__('Status'))
                            ->options([
                                'accepted' => __('Accepted'),
                                'rejected' => __('Rejected'),
                            ])
                            ->required(),
                    ])
                    ->action(function (ResetVerifiedCredentials $record, array $data) {
                        $email = $data['email'];
                        $status = $data['status'];
                        $newPassword = Str::random(10);

                        // Update the record
                        $record->update([
                            'email' => $email,
                            'status' => $status,
                        ]);

                        if ($status === 'accepted') {
                            $user = User::where('email', $email)->first();
                            if ($user) {
                                $user->password = Hash::make($newPassword);
                                $isUpdated = $user->save();

                                if ($isUpdated) {
                                    $user->notify(new RestoreVerifiedAccountCredentialsNotification($newPassword, $user));

                                    Notification::make()
                                        ->title(__('User Verified and Notified'))
                                        ->success()
                                        ->send();
                                } else {
                                    Notification::make()
                                        ->title(__('Failed to update user password!'))
                                        ->danger()
                                        ->send();
                                }
                            } else {
                                Notification::make()
                                    ->title(__('User not found with the provided email!'))
                                    ->danger()
                                    ->send();
                            }
                        } else {
                            Notification::make()
                                ->title(__('User status updated to "Rejected"'))
                                ->warning()
                                ->send();
                        }
                    })
                    ->visible(fn(ResetVerifiedCredentials $record) => $record->status === 'pending')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResetVerifiedPasswordComponents::route('/'),
            'create' => Pages\CreateResetVerifiedPasswordComponent::route('/create'),
            'edit' => Pages\EditResetVerifiedPasswordComponent::route('/{record}/edit'),
        ];
    }
}
