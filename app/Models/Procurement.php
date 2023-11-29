<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_fee_amount',
        'contractor_fee_amount',
        'description'
    ];

    public function departmentprocurements() {
        return $this->hasMany(DepartmentProcurement::class, 'procurement_id');
    }

    public function procurementdocuments() {
        return $this->hasMany(ProcurementDocument::class, 'procurement_id');
    }
}
