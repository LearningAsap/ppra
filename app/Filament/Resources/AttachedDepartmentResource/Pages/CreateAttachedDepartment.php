<?php

namespace App\Filament\Resources\AttachedDepartmentResource\Pages;

use App\Filament\Resources\AttachedDepartmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttachedDepartment extends CreateRecord
{
    protected static string $resource = AttachedDepartmentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
