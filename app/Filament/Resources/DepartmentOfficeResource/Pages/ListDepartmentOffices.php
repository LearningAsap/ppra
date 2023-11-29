<?php

namespace App\Filament\Resources\DepartmentOfficeResource\Pages;

use App\Filament\Resources\DepartmentOfficeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepartmentOffices extends ListRecords
{
    protected static string $resource = DepartmentOfficeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
