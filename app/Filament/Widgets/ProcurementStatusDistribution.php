<?php

namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use App\Models\DepartmentProcurement;

class ProcurementStatusDistribution extends PieChartWidget
{
    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = 32;

    protected function getHeading(): string
    {
        return 'Procurement Status Distribution';
    }

    protected function getData(): array
    {
        // Implement your logic to get data similar to the previous example
        $data = $this->getDataForPieChart();

        return $data;
    }

    protected function getDataForPieChart(): array
    {
        // Your existing data retrieval logic here...
        // Make sure to adjust the labels and data accordingly

        $labels = ['Approved Procurements', 'Rejected Procurements', 'Procurments in Objection', 'Procurements Waiting for Action'];

        $data = [
            'datasets' => [
                [
                    'data' => $this->getProcurementStatusCounts(),
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                    ],
                ],
            ],
            'labels' => $labels,
        ];

        return $data;
    }

    protected function getProcurementStatusCounts(): array
    {
        if(auth()->user()->user_role == 0){
            // Fetch and store the counts for each procurement status
            $approvedCount = DepartmentProcurement::where('status', 1)->count();
            $rejectedCount = DepartmentProcurement::where('status', 0)->count();
            $objectionCount = DepartmentProcurement::where('status', 2)->count();
            $waitingCount = DepartmentProcurement::where('status', 3)->count();
        } else if(auth()->user()->user_role == 1){
            // Fetch and store the counts for each procurement status
            $approvedCount = DepartmentProcurement::where('status', 1)->count();
            $rejectedCount = DepartmentProcurement::where('status', 0)->count();
            $objectionCount = DepartmentProcurement::where('status', 2)->count();
            $waitingCount = DepartmentProcurement::where('status', 3)->count();
        } else if(auth()->user()->user_role == 2){
            // Fetch and store the counts for each procurement status
            $approvedCount = DepartmentProcurement::where('status', 1)->where('ddo_code', auth()->user()->ddo_code)->count();
            $rejectedCount = DepartmentProcurement::where('status', 0)->where('ddo_code', auth()->user()->ddo_code)->count();
            $objectionCount = DepartmentProcurement::where('status', 2)->where('ddo_code', auth()->user()->ddo_code)->count();
            $waitingCount = DepartmentProcurement::where('status', 3)->where('ddo_code', auth()->user()->ddo_code)->count();
        }

        return [$approvedCount, $rejectedCount, $objectionCount, $waitingCount];
    }
}
