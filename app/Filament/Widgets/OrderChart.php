<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;

class OrderChart extends LineChartWidget
{
    protected static ?string $heading = 'Orders per month';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $orders = Order::selectRaw('DATE_FORMAT(created_at, "%M") as month, COUNT(*) as count')
        ->groupBy('month')
        ->get();

        $months = [];
        $orderCounts = [];

        foreach ($orders as $item) {
            $months[] = Carbon::parse($item['month'])->format('M');
            $orderCounts[] = $item['count'];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $orderCounts,
                ],
            ],
            'labels' => $months,

        ];
    }
}
