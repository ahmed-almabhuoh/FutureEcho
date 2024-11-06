<?php

namespace App\Filament\Resources\ContributorPermissionResource\Pages;

use App\Filament\Resources\ContributorPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContributorPermissions extends ListRecords
{
    protected static string $resource = ContributorPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
