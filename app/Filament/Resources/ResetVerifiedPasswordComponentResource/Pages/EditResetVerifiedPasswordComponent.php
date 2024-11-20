<?php

namespace App\Filament\Resources\ResetVerifiedPasswordComponentResource\Pages;

use App\Filament\Resources\ResetVerifiedPasswordComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResetVerifiedPasswordComponent extends EditRecord
{
    protected static string $resource = ResetVerifiedPasswordComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
