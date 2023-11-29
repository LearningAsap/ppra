<?php

namespace App\Models;

use App\Models\DepartmentOffice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartmentProcurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ddo_code',
        'procurement_id',
        'title',
        'description',
        'tender_notice',
        'tender_document',
        'opening_date',
        'closing_date',
        'status'
    ];

    public function departmentoffice() {
        return $this->belongsTo(DepartmentOffice::class, 'ddo_code', 'ddo_code');
    }

    public function procurement() {
        return $this->belongsTo(Procurement::class, 'procurement_id');
    }

    // public function contractorprocurments() {
    //     return $this->hasMany(ContractorProcurement::class, 'department_procurement_id');
    // }

    public function departmentprocurementcomments() {
        return $this->hasMany(DeptProcComment::class, 'department_procurement_id');
    }

    public function procurementdocuments() {
        return $this->hasMany(ProcurementDocument::class, 'department_procurement_id');
    }
}
