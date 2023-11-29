<?php

namespace App\Filament\Resources\AttachedDepartmentResource\Pages;

use App\Filament\Resources\AttachedDepartmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttachedDepartments extends ListRecords
{
    protected static string $resource = AttachedDepartmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
