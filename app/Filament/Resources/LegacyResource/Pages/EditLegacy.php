<?php

namespace App\Filament\Resources\LegacyResource\Pages;

use App\Filament\Resources\LegacyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLegacy extends EditRecord
{
    protected static string $resource = LegacyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
