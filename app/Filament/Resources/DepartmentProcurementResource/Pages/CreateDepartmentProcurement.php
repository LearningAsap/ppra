<?php

namespace App\Filament\Resources\DepartmentProcurementResource\Pages;

use App\Filament\Resources\DepartmentProcurementResource;
use App\Mail\DpisPublished;
use App\Mail\EmailIsCreated;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateDepartmentProcurement extends CreateRecord
{
    protected static string $resource = DepartmentProcurementResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /* protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::where('ddo_code', $data['ddo_code'])->where('is_active', 1)->first();

        Mail::to($user->email)->send(new DpisPublished($user, $data));

        return $data;
    } */

    protected function afterCreate(): void
    {
        $admin_email = env('MAIL_ADMIN_EMAIL');
        $data = $this->record->toArray();
        $user = User::where('ddo_code', $data['ddo_code'])->where('is_active', 1)->first();

        Mail::to($admin_email)->send(new EmailIsCreated($user, $data));
        // Runs after the form fields are saved to the database.
    }

    /* protected function afterCreate(): void
    {
        Notification::make()
            ->title('New Department Procurement Created')
            ->sendToDatabase(User::where('user_role', 1)->first());
    } */
}
