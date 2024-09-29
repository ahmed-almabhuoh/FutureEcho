<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;
    protected function getCreateAction(): ?Actions\Action
    {

        return Setting::exists() ? null : parent::getCreateAction();
    }

    protected function getEditAction(): ?Actions\Action
    {
        return Actions\EditAction::make();
    }
}
