<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptProcComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_procurement_id',
        'comment'
    ];

    public function departmentprocurement() {
        return $this->belongsTo(DepartmentProcurement::class, 'department_procurement_id');
    }
}
