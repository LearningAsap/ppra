<?php

namespace App\Filament\Resources\DepartmentProcurementResource\Pages;

use App\Filament\Resources\DepartmentProcurementResource;
use App\Mail\DpisPublished;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditDepartmentProcurement extends EditRecord
{
    protected static string $resource = DepartmentProcurementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    /* protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = User::where('ddo_code', $data['ddo_code'])->where('is_active', 1)->first();

        Mail::to($user->email)->send(new DpisPublished($user, $data));

        return $data;
    } */

    protected function afterSave(): void
    {
        $data = $this->record->toArray();
        $user = User::where('ddo_code', $data['ddo_code'])->where('is_active', 1)->first();

        Mail::to($user->email)->send(new DpisPublished($user, $data));

        // Runs after the form fields are saved to the database.
    }

    /* protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    } */
}
