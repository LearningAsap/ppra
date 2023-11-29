<?php

namespace App\Filament\Resources\AttachedDepartmentResource\Pages;

use App\Filament\Resources\AttachedDepartmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttachedDepartment extends EditRecord
{
    protected static string $resource = AttachedDepartmentResource::class;

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
