<?php

namespace App\Filament\Widgets;

use App\Models\DepartmentProcurement;
use Filament\Widgets\LineChartWidget;

class MonthlyProcurementTrendsChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected int | string | array $columnSpan = 4;

    protected static ?int $sort = 31;

    protected function getHeading(): string
    {
        return 'Monthly Procurement Trends';
    }

    protected function getData(): array
    {
        // Implement your logic to get data similar to the previous example
        $data = $this->getDataForLineChart();

        return $data;
    }

    protected function getDataForLineChart(): array
    {
        // Your existing data retrieval logic here...
        // Make sure to adjust the labels and data accordingly

        $data = [
            'datasets' => [
                [
                    'label' => 'Procurements Count',
                    'data' => $this->getMonthlyProcurementsCount(),
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                ],
            ],
            'labels' => $this->getMonthlyLabels(),
        ];

        return $data;
    }

    protected function getMonthlyProcurementsCount(): array
    {
        // Fetch and store the monthly counts for procurements
        $counts = [];

        // Loop through the last 12 months
        for ($i = 0; $i < 12; $i++) {
            // Calculate the month and year for each iteration
            $month = date('F', mktime(0, 0, 0, date('m') - $i, 1));
            $year = date('Y');

            // If the current month is less than $i, adjust the year
            if (date('m') - $i <= 0) {
                $month = date('F', mktime(0, 0, 0, 12 + (date('m') - $i), 1));
                $year = date('Y') - 1;
            }

            if(auth()->user()->user_role == 0) {
                $counts[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', date('m') - $i)
                    ->count();
            } else if(auth()->user()->user_role == 1) {
                $counts[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', date('m') - $i)
                    ->count();
            } else {
                $counts[] = DepartmentProcurement::where('ddo_code', auth()->user()->ddo_code)
                    ->whereYear('opening_date', $year)
                    ->whereMonth('opening_date', date('m') - $i)
                    ->count();
            }
        }

        return $counts;
    }

    protected function getMonthlyLabels(): array
    {
        // Initialize an array to store the labels (months and years)
        $labels = [];

        // Loop through the last 12 months
        for ($i = 0; $i < 12; $i++) {
            // Calculate the month and year for each iteration
            $month = date('F', mktime(0, 0, 0, date('m') - $i, 1));
            $year = date('Y');

            // If the current month is less than $i, adjust the year
            if (date('m') - $i <= 0) {
                $month = date('F', mktime(0, 0, 0, 12 + (date('m') - $i), 1));
                $year = date('Y') - 1;
            }

            // Add the label to the labels array
            $labels[] = $month . ' ' . $year;
        }

        return $labels;
    }
}
