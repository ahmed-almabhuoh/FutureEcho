<?php

namespace App\Filament\Resources\ResetVerifiedPasswordComponentResource\Pages;

use App\Filament\Resources\ResetVerifiedPasswordComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResetVerifiedPasswordComponents extends ListRecords
{
    protected static string $resource = ResetVerifiedPasswordComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
