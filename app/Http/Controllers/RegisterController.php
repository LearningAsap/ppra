<?php

namespace App\Http\Controllers;

use App\Models\DepartmentOffice;
use App\Models\User;
use Illuminate\Http\Request; // Add this line
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotify;
use App\Mail\SignupMail;

class RegisterController extends Controller
{
    protected $page_title = 'Public Procurement Regulatory Authority GB (PPRA) | Home';

    public function viewsignup()
    {
        $selected_main_menu = 'Registration';

        $this->page_title = 'Public Procurement Regulatory Authority GB (PPRA) | Contact';
        $ddoCodes = DepartmentOffice::all()->pluck('description', 'ddo_code');

        return view('home.signup')
            ->with('selected_main_menu', $selected_main_menu)
            ->with('ddoCodes', $ddoCodes)
            ->with('page_title', $this->page_title);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'ddo_code' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'user_role' => 'required|int',
        ]);

        if (class_exists(\App\Mail\SignupMail::class) && class_exists(\App\Mail\AdminNotify::class)) {
            // Mail classes exist, so execute the code inside this block

            $user = User::create([
                'user_name' => $request->input('username'),
                'ddo_code' => $request->input('ddo_code'),
                'user_role' => $request->input('user_role'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'is_active' => 0,
            ]);

            // Send emails
            $this->sendUserEmail($user);
            $this->sendAdminEmail($user);

            // Redirect to a success page or do something else
            return redirect('/register')->with('success', 'You have successfully registered. Please wait for the admin to activate your account.');
        } else {
            // Mail classes don't exist, so execute the code inside this block
            // Redirect to a failure page or do something else
            return redirect('/register')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    protected function sendUserEmail(User $user)
    {
        Mail::to($user->email)->send(new SignupMail($user));
    }

    protected function sendAdminEmail(User $user)
    {
        Mail::to(env('ADMIN_EMAIL'))->send(new AdminNotify($user));
    }
}
