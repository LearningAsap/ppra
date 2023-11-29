<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'ddo_code',
        'user_role',
        'email',
        'password',
        'is_active',
        'remember_token',
        'is_active',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departmentoffice()
    {
        return $this->belongsTo(DepartmentOffice::class, 'ddo_code', 'ddo_code');
    }

    public function canAccessFilament(): bool
    {
        //return str_ends_with($this->email, '@dmin.com');
        if ($this->user_role == 0) {
            return true;
        } elseif ($this->user_role == 1) {
            return true;
        } elseif ($this->user_role == 2) {
            return true;
        } else {
            return false;
        }
    }
}
