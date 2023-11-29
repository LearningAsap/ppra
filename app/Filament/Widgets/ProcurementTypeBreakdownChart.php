<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\DepartmentProcurement;

class ProcurementTypeBreakdownChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected int | string | array $columnSpan = 3;

    protected static ?int $sort = 35;

    public function __construct()
    {
        if(auth()->user()->user_role == 0) {
            $this->columnSpan = 3;
        } else if(auth()->user()->user_role == 1) {
            $this->columnSpan = 3;
        } else {
            $this->columnSpan = 4;
        }
    }

    protected function getHeading(): string
    {
        return 'Procurement Type Breakdown';
    }

    protected function getData(): array
    {
        // Implement your logic to get data based on the Procurement relationship
        $data = $this->getDataForBarChart();

        return $data;
    }

    protected function getDataForBarChart(): array
    {
        // Fetch all unique procurement types from the database
        $procurementTypes = \App\Models\Procurement::pluck('name');

        // Initialize the datasets array
        $datasets = [];

        // Loop through each procurement type
        foreach ($procurementTypes as $type) {
            // Add a dataset for each procurement type
            $datasets[] = [
                'label' => $type,
                'data' => $this->getProcurementTypeCount($type),
                'backgroundColor' => $this->generateRandomColor(), // You can customize colors if needed
            ];
        }

        // Get the labels (months) - modify this if needed
        $labels = $this->getMonthLabels();

        // Create the final array
        $result = [
            'datasets' => $datasets,
            'labels' => $labels,
        ];

        return $result;
    }

    protected function getProcurementTypeCount(string $type): array
    {
        // Fetch and store the counts for each procurement type
        $counts = [];

        // Loop through the last 12 months
        for ($i = 0; $i < 12; $i++) {
            // Calculate the month and year for each iteration
            $month = date('m', strtotime("-$i months"));
            $year = date('Y', strtotime("-$i months"));

            if(auth()->user()->user_role == 0) {
                // Add the count to the counts array
                $counts[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $month)
                    ->whereHas('procurement', function ($query) use ($type) {
                        $query->where('name', $type);
                    })
                    ->count();
            } else if(auth()->user()->user_role == 1) {
                // Add the count to the counts array
                $counts[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $month)
                    ->whereHas('procurement', function ($query) use ($type) {
                        $query->where('name', $type);
                    })
                    ->count();
            } else {
                // Add the count to the counts array
                $counts[] = DepartmentProcurement::whereYear('opening_date', $year)
                    ->whereMonth('opening_date', $month)
                    ->whereHas('procurement', function ($query) use ($type) {
                        $query->where('name', $type);
                    })
                    ->where('ddo_code', auth()->user()->ddo_code)
                    ->count();
            }
        }

        return $counts;
    }

    protected function getMonthLabels(): array
    {
        // Initialize an array to store the labels (months and years)
        $labels = [];

        // Loop through the last 12 months
        for ($i = 0; $i < 12; $i++) {
            // Calculate the month and year for each iteration
            $month = date('F', strtotime("-$i months"));
            $year = date('Y', strtotime("-$i months"));

            // Add the label to the labels array
            $labels[] = $month . ' ' . $year;
        }

        return $labels;
    }

    protected function generateRandomColor(): string
    {
        // Predefined set of appealing colors
        $colors = [
            'rgba(75, 192, 192, 0.7)',
            'rgba(255, 99, 132, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            // Add more colors as needed
        ];

        // Use the colors sequentially
        static $index = 0;
        $color = $colors[$index];

        // Increment the index for the next color
        $index = ($index + 1) % count($colors);

        return $color;
    }
}
