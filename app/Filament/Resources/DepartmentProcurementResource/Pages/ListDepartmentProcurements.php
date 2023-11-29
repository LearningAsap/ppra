<?php

namespace App\Filament\Resources\DepartmentProcurementResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Database\Query\Builder;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DepartmentProcurementResource;

class ListDepartmentProcurements extends ListRecords
{
    protected static string $resource = DepartmentProcurementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
