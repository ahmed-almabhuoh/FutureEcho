<?php

namespace App\Filament\Resources\CapsuleResource\Pages;

use App\Filament\Resources\CapsuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCapsules extends ListRecords
{
    protected static string $resource = CapsuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
