<?php

namespace App\Filament\Resources\DepartmentOfficeResource\Pages;

use App\Filament\Resources\DepartmentOfficeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDepartmentOffice extends EditRecord
{
    protected static string $resource = DepartmentOfficeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
