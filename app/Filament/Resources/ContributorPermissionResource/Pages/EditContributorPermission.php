<?php

namespace App\Filament\Resources\ContributorPermissionResource\Pages;

use App\Filament\Resources\ContributorPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContributorPermission extends EditRecord
{
    protected static string $resource = ContributorPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
