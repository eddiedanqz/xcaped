<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use DB;
use Filament\Widgets\LineChartWidget;

class RevenueChart extends LineChartWidget
{
    protected static ?string $heading = 'Revenue per month';

    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $results = Order::select(
            // DB::raw('YEAR(created_at) as year'),
            DB::raw("DATE_FORMAT(created_at, '%b') as month"),
            DB::raw('SUM(grand_total) as total')
        )
        ->groupBy('month')
        ->get();

        $months = [];
        $total = [];

        foreach ($results as $item) {
            $months[] = $item['month'];
            $total[] = $item['total'] * (6 / 100);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenues',
                    'data' => $total,
                ],
            ],
            'labels' => $months,

        ];
    }
}
