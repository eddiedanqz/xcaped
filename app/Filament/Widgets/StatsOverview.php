<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use App\Settings\GeneralSettings;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use  Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $rate = app(GeneralSettings::class)->commission;
        $gross = Order::sum('grand_total');
        $commission = $gross * ($rate / 100);
        $net = $gross - $commission;

        return [
            Card::make('Total Users', User::count())
            ->color('success'),
            Card::make('New Users', User::where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())->count())
                ->color('danger'),
            Card::make('Commission', $rate.'%'),
            Card::make('Gross Revenue', number_format($gross, 2))
            ->color('danger'),
            Card::make('Net Revenue', number_format($net, 2))
            ->color('success'),
            Card::make('Total Revenue', number_format($commission, 2)),
        ];
    }
}
