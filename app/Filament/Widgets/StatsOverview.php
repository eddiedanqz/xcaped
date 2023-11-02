<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $sum = Order::sum('grand_total');
        $paid_out = $sum * (6 / 100);

        return [
            Card::make('Total Users', User::count())
            ->description('32k increase')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),
            Card::make('New Users', User::where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())->count())
                ->description('7% increase')
                ->descriptionIcon('heroicon-s-trending-down')
                ->color('danger'),
            Card::make('Total Revenue', $paid_out)
                ->description('3% increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),
        ];
    }
}
