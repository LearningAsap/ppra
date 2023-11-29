<?php

namespace App\Filament\Widgets;

use App\Models\DepartmentProcurement;
use Filament\Widgets\DoughnutChartWidget;

class ProcurementStatusPercentageChart extends DoughnutChartWidget
{
    protected static ?string $heading = 'Procurement Status Percentage';

    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = 33;

    protected function getHeading(): string
    {
        return 'Procurement Status Percentage';
    }

    protected function getData(): array
    {
        if(auth()->user()->user_role == 0) {
            $approvedCount = DepartmentProcurement::where('status', 1)->count();
            $rejectedCount = DepartmentProcurement::where('status', 0)->count();
            $inObjectionCount = DepartmentProcurement::where('status', 2)->count();
            $pendingCount = DepartmentProcurement::where('status', '!=', 1)->where('status', '!=', 0)->where('status', '!=', 2)->count();
        } else if(auth()->user()->user_role == 1) {
            $approvedCount = DepartmentProcurement::where('status', 1)->count();
            $rejectedCount = DepartmentProcurement::where('status', 0)->count();
            $inObjectionCount = DepartmentProcurement::where('status', 2)->count();
            $pendingCount = DepartmentProcurement::where('status', '!=', 1)->where('status', '!=', 0)->where('status', '!=', 2)->count();
        } else {
            $approvedCount = DepartmentProcurement::where('status', 1)->where('ddo_code', auth()->user()->ddo_code)->count();
            $rejectedCount = DepartmentProcurement::where('status', 0)->where('ddo_code', auth()->user()->ddo_code)->count();
            $inObjectionCount = DepartmentProcurement::where('status', 2)->where('ddo_code', auth()->user()->ddo_code)->count();
            $pendingCount = DepartmentProcurement::where('status', '!=', 1)->where('status', '!=', 0)->where('status', '!=', 2)->where('ddo_code', auth()->user()->ddo_code)->count();
        }

        // Calculate percentages
        $totalCount = $approvedCount + $rejectedCount + $pendingCount + $inObjectionCount;
        $approvedPercentage = $approvedCount > 0 ? ($approvedCount / $totalCount) * 100 : 0;
        $rejectedPercentage = $rejectedCount > 0 ? ($rejectedCount / $totalCount) * 100 : 0;
        $inObjectionPercentage = $inObjectionCount > 0 ? ($inObjectionCount / $totalCount) * 100 : 0;
        $pendingPercentage = $pendingCount > 0 ? ($pendingCount / $totalCount) * 100 : 0;

        // Create the final array
        $result = [
            'datasets' => [
                [
                    'data' => [$approvedPercentage, $rejectedPercentage, $inObjectionPercentage, $pendingPercentage],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 1)', // Approved color
                        'rgba(255, 99, 132, 1)', // Rejected color
                        'rgba(54, 162, 235, 1)', // In Objection color
                        'rgba(255, 205, 86, 1)', // Pending color
                    ],
                ],
            ],
            'labels' => ['Approved', 'Rejected', 'In Objection', 'Pending'],
        ];

        return $result;
    }
}
