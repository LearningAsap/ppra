<?php

namespace Filament\Http\Responses\Auth;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as Responsable;
use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;

class LoginResponse implements Responsable
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        if (auth()->user()->is_active) {
            return redirect()->intended(Filament::getUrl());
        }

        auth()->logout();

        return redirect()->to('admin/login');
    }
}
