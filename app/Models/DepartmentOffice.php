<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'ddo_code',
        'attached_department_code',
        'description'
    ];

    public function attacheddepartment() {
        return $this->belongsTo(AttachedDepartment::class, 'attached_department_code');
    }

    public function departmentprocurements() {
        return $this->hasMany(DepartmentProcurement::class, 'ddo_code', 'ddo_code');
    }
}
