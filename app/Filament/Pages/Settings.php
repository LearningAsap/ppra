<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament.pages.settings';

    protected static ?int $navigationSort = 11;

    public $user_id;
    public $user_name;
    public $user_role;
    public $email;
    public $old_password;
    public $password;
    public $confirm_password;
    //public $is_active;

    public function mount() {
        $this->user_id = auth()->user()->id;
        $this->user_name = auth()->user()->user_name;
        $this->user_role = auth()->user()->user_role;
        $this->email = auth()->user()->email;
        //$this->is_active = auth()->user()->is_active;
    }

    public function save()
    {
        $validateData = [
            'password' => [
                'required',
                'string',
                'different:old_password',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ],
            'old_password' => [
                'required',

                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Your old password does not match.');
                    }
                }
            ],
            'confirm_password' => 'required|min:8|same:password'
        ];

        $this->validate($validateData);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($this->password);
        $user->remember_token = Str::random(60);
        $user->save();

        Session::flush();

        return redirect()->route('filament.auth.login');
    }
}
