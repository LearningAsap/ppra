<?php

namespace App\Filament\Resources\DepartmentOfficeResource\Pages;

use App\Filament\Resources\DepartmentOfficeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDepartmentOffice extends CreateRecord
{
    protected static string $resource = DepartmentOfficeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

