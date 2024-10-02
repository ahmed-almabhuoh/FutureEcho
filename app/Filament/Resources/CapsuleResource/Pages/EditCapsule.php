<?php

namespace App\Filament\Resources\CapsuleResource\Pages;

use App\Filament\Resources\CapsuleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCapsule extends EditRecord
{
    protected static string $resource = CapsuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
