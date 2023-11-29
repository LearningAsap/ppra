<?php

namespace App\Filament\Widgets;

use App\Models\AttachedDepartment;
use App\Models\ContractorProcurement;
use App\Models\Department;
use App\Models\DepartmentOffice;
use App\Models\DepartmentProcurement;
use App\Models\District;
use App\Models\Procurement;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 6;

    protected static ?int $sort = 30;

    public static function canView(): bool
    {
        if(auth()->user()->user_role == 0) {
            return true;
        } else if(auth()->user()->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }

    protected function getCards(): array
    {
        return [
            //Card::make('Districts', District::count()),
            Card::make('Procurement Types', Procurement::count()),
            Card::make('Departments', Department::count()),
            Card::make('Attached Departments', AttachedDepartment::count()),
            Card::make('Department Offices', DepartmentOffice::count()),
            Card::make('Total Procurements', DepartmentProcurement::count()),
            Card::make('Procurements Waiting for Action', DepartmentProcurement::where('status', 3)->count()),
            Card::make('Approved Procurements', DepartmentProcurement::where('status', 1)->count()),
            Card::make('Rejected Procurements', DepartmentProcurement::where('status', 0)->count()),
            Card::make('In Objection Procurements', DepartmentProcurement::where('status', 2)->count()),
            Card::make('Approved User Accounts', User::where('user_role', 2)->where('is_active', 1)->count()),
            Card::make('Pending User Accounts', User::where('user_role', 2)->where('is_active', 0)->count()),


            //Card::make('Non Objection Procurements', DepartmentProcurement::where('is_in_objection', 0)->count()),

            //Card::make('Total Contractors', ContractorProcurement::count()),
            //Card::make('Active Contractors', ContractorProcurement::where('is_active', 1)->count()),
            //Card::make('Inactive Contractors', ContractorProcurement::where('is_active', 0)->count()),

        ];
    }
}
