<?php

namespace App\Filament\Resources\DepartmentProcurementResource\Pages;

use App\Filament\Resources\DepartmentProcurementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartmentProcurement extends ViewRecord
{
    protected static string $resource = DepartmentProcurementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
