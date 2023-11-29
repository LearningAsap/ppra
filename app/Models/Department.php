<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'description'
    ];

    public function attacheddepartments() {
        return $this->hasMany(AttachedDepartment::class, 'department_id', 'department_id');
    }
}
