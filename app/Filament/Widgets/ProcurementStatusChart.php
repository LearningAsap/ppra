<?php

namespace App\Filament\Widgets;

use App\Models\DepartmentProcurement;
use Filament\Widgets\BarChartWidget;

class ProcurementStatusChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected int | string | array $columnSpan = 3;

    protected static ?int $sort = 36;

    public function __construct()
    {
        if(auth()->user()->user_role == 0) {
            $this->columnSpan = 3;
        } else if(auth()->user()->user_role == 1) {
            $this->columnSpan = 3;
        } else {
            $this->columnSpan = 6;
        }
    }

    protected function getHeading(): string
    {
        return 'Monthwise Procurements Count';
    }

    protected function getData(): array
    {
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Initialize an array to store the labels (months and years)
        $labels = [];

        // Initialize arrays for each dataset
        $approvedProcurements = [];
        $rejectedProcurements = [];
        $procurementsInObjection = [];
        $procurementsWaitingForAction = [];

        // Loop through the last 12 months
        for ($i = 0; $i < 12; $i++) {
            // Calculate the month and year for each iteration
            $month = date('F', mktime(0, 0, 0, $currentMonth - $i, 1));
            $year = $currentYear;

            // If the current month is less than $i, adjust the year
            if ($currentMonth - $i <= 0) {
                $month = date('F', mktime(0, 0, 0, 12 + ($currentMonth - $i), 1));
                $year = $currentYear - 1;
            }

            // Add the label to the labels array
            $labels[] = $month . ' ' . $year;

            if(auth()->user()->user_role == 0) {
                // Fetch and store the monthly counts for each dataset
            $approvedProcurements[] = DepartmentProcurement::whereYear('opening_date', $year)
                ->whereMonth('opening_date', $currentMonth - $i)
                ->where('status', 1)
                ->count();

            $rejectedProcurements[] = DepartmentProcurement::whereYear('opening_date', $year)
                ->whereMonth('opening_date', $currentMonth - $i)
                ->where('status', 0)
                ->count();

            $procurementsInObjection[] = DepartmentProcurement::whereYear('opening_date', $year)
                ->whereMonth('opening_date', $currentMonth - $i)
                ->where('status', 2)
                ->count();

            $procurementsWaitingForAction[] = DepartmentProcurement::whereYear('opening_date', $year)
                ->whereMonth('opening_date', $currentMonth - $i)
                ->where('status', 3)
                ->count();
            } else if(auth()->user()->user_role == 1) {
                $approvedProcurements[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 1)
                    ->count();

                $rejectedProcurements[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 0)
                    ->count();

                $procurementsInObjection[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 2)
                    ->count();

                $procurementsWaitingForAction[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 3)
                    ->count();
            } else {
                // Fetch and store the monthly counts for each dataset
                $approvedProcurements[] = DepartmentProcurement::where('ddo_code', auth()->user()->ddo_code)
                    ->whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 1)
                    ->count();

                $rejectedProcurements[] = DepartmentProcurement::where('ddo_code', auth()->user()->ddo_code)
                    ->whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 0)
                    ->count();

                $procurementsInObjection[] = DepartmentProcurement::where('ddo_code', auth()->user()->ddo_code)
                    ->whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 2)
                    ->count();

                $procurementsWaitingForAction[] = DepartmentProcurement::where('ddo_code', auth()->user()->ddo_code)
                    ->whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $currentMonth - $i)
                    ->where('status', 3)
                    ->count();
            }


        }

        // Create the datasets array
        $datasets = [
            [
                'label' => 'Approved Procurements',
                'data' => $approvedProcurements,
                'backgroundColor' => 'rgba(220, 252, 231, 1)',
            ],
            [
                'label' => 'Rejected Procurements',
                'data' => $rejectedProcurements,
                'backgroundColor' => 'rgba(255, 228, 230, 1)',
            ],
            [
                'label' => 'Procurments in Objection',
                'data' => $procurementsInObjection,
                'backgroundColor' => 'rgba(219, 234, 254, 1)',
            ],
            [
                'label' => 'Procurements Waiting for Action',
                'data' => $procurementsWaitingForAction,
                'backgroundColor' => 'rgba(254, 249, 195, 1)',
            ],
        ];

        // Create the final array
        $result = [
            'datasets' => $datasets,
            'labels' => $labels,
        ];

        return $result;
    }
}
