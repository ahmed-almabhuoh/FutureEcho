<?php

namespace App\Filament\Resources\LegacyResource\Pages;

use App\Filament\Resources\LegacyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegacies extends ListRecords
{
    protected static string $resource = LegacyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
