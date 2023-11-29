<?php

/* namespace App\Filament\Pages;

use App\Models\GeneralSetting;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Notifications\Notification;

class ScanQRCode extends Page
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-s-camera';

    protected static string $view = 'filament.pages.scan-qr-code';

    protected static ?int $navigationSort = 11;

    protected static function shouldRegisterNavigation(): bool
    {
        if(auth()->user()->user_role == 0) {
            return true;
        }

        return false;
    }

    public $code;

    public function scan()
    {
        $this->dispatchBrowserEvent('scan');
    }

    public function scanned($code)
    {
        $this->scan($code);
    }
}
 */
