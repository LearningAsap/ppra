<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachedDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'attached_department_code',
        'department_id',
        'description'
    ];

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function departmentoffices() {
        return $this->hasMany(DepartmentOffice::class, 'attached_department_code', 'attached_department_code');
    }
}
