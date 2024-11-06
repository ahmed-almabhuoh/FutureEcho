<?php

namespace App\Filament\Resources\ContributorPermissionResource\Pages;

use App\Filament\Resources\ContributorPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContributorPermission extends ViewRecord
{
    protected static string $resource = ContributorPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
