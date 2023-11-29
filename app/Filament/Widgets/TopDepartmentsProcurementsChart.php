<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\DepartmentProcurement;

class TopDepartmentsProcurementsChart extends BarChartWidget
{
    protected static ?string $heading = 'Top 20 Departments by Procurements';

    protected int | string | array $columnSpan = 4;

    protected static ?int $sort = 34;

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

    protected function getHeading(): string
    {
        return 'Top 20 Departments by Procurements';
    }

    protected function getData(): array
    {
        // Get the top 20 departments with the most procurements for each status
        $topDepartments = DepartmentProcurement::
            join('department_offices', 'department_procurements.ddo_code', '=', 'department_offices.ddo_code')
            ->selectRaw('department_offices.ddo_code, department_offices.description,
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as rejected,
                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as in_objection,
                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as waiting_for_action,
                COUNT(*) as total')
            ->groupBy('department_offices.ddo_code', 'department_offices.description')
            ->orderByDesc('total')
            ->limit(20)
            ->get();

            //dd($topDepartments);

        // Extract department names and counts for each status
        $departmentNames = $topDepartments->pluck('ddo_code')->toArray();
        $approvedCounts = $topDepartments->pluck('approved')->toArray();
        $rejectedCounts = $topDepartments->pluck('rejected')->toArray();
        $inObjectionCounts = $topDepartments->pluck('in_objection')->toArray();
        $waitingForActionCounts = $topDepartments->pluck('waiting_for_action')->toArray();
        $totalCounts = $topDepartments->pluck('total')->toArray();

         // Debugging statements
    //dd($departmentNames, $approvedCounts, $rejectedCounts, $inObjectionCounts, $waitingForActionCounts, $totalCounts);

        // Create the final array
        $result = [
            'datasets' => [
                [
                    'label' => 'Approved',
                    'data' => $approvedCounts,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                ],
                [
                    'label' => 'Rejected',
                    'data' => $rejectedCounts,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                ],
                [
                    'label' => 'In Objection',
                    'data' => $inObjectionCounts,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                ],
                [
                    'label' => 'Waiting for Action',
                    'data' => $waitingForActionCounts,
                    'backgroundColor' => 'rgba(255, 205, 86, 0.8)',
                ],
                [
                    'label' => 'Total',
                    'data' => $totalCounts,
                    'backgroundColor' => 'rgba(12, 13, 150, 0.5)',
                ],
            ],
            'labels' => $departmentNames,
        ];

        return $result;
    }
}
