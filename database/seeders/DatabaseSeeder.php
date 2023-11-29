<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\GeneralSetting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* $role = new Role();
        $role->role_name = 'admin';
        $role->save(); */

        $user = new User();
        $user->user_name = 'admin';
        $user->user_role = 0;
    	$user->email = 'admin@ppragb.gov.pk';
    	$user->password = Hash::make('password123');
    	$user->save();

        $gs = new GeneralSetting;
        $gs->id = 1;
        $gs->department_full_name = "Enter Department Name in this field.";
        $gs->department_logo = "/public/img/logo.png";
        $gs->save();
    }
}
