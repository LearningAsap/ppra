<?php

namespace App\Filament\Widgets;

use App\Models\AttachedDepartment;
use App\Models\ContractorProcurement;
use App\Models\Department;
use App\Models\DepartmentOffice;
use App\Models\DepartmentProcurement;
use App\Models\District;
use App\Models\Procurement;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverviewDpt extends BaseWidget
{
    protected int | string | array $columnSpan = 6;

    protected static ?int $sort = 30;

    public static function canView(): bool
    {
        if(auth()->user()->user_role == 2) {
            return true;
        }

        return false;
    }

    protected function getCards(): array
    {
        return [
            Card::make('Total Procurements', DepartmentProcurement::where('ddo_code', auth()->user()->ddo_code)->count()),
            Card::make('Procurements Waiting for Action', DepartmentProcurement::where('status', 3)->where('ddo_code', auth()->user()->ddo_code)->count()),
            Card::make('Approved Procurements', DepartmentProcurement::where('status', 1)->where('ddo_code', auth()->user()->ddo_code)->count()),
            Card::make('Rejected Procurements', DepartmentProcurement::where('status', 0)->where('ddo_code', auth()->user()->ddo_code)->count()),
            Card::make('Procurements In Objection', DepartmentProcurement::where('status', 2)->where('ddo_code', auth()->user()->ddo_code)->count()),
            //Card::make('Paid Procurements', DepartmentProcurement::where('is_paid', 1)->where('ddo_code', auth()->user()->ddo_code)->count()),
            //Card::make('Unpaid Procurements', DepartmentProcurement::where('is_paid', 0)->where('ddo_code', auth()->user()->ddo_code)->count()),
            //Card::make('Total Contractors', ContractorProcurement::join('department_procurements', 'department_procurements.id', '=', 'contractor_procurements.department_procurement_id')->where('department_procurements.ddo_code', auth()->user()->ddo_code)->count()),
            //Card::make('Active Contractors', ContractorProcurement::join('department_procurements', 'department_procurements.id', '=', 'contractor_procurements.department_procurement_id')->where('is_active', 1)->where('department_procurements.ddo_code', auth()->user()->ddo_code)->count()),

        ];
    }
}
