<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_procurement_id',
        'title',
        'file',
        'procurement_id'
    ];

    public function departmentprocurement() {
        return $this->belongsTo(DepartmentProcurement::class, 'department_procurement_id');
    }

    public function procurement() {
        return $this->belongsTo(Procurement::class, 'procurement_id');
    }
}
