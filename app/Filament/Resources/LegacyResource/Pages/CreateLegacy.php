<?php

namespace App\Filament\Resources\LegacyResource\Pages;

use App\Filament\Resources\LegacyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLegacy extends CreateRecord
{
    protected static string $resource = LegacyResource::class;
}
