<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use DB;

class DashboardController extends Controller
{
    public function index(Event $event)
    {
        $sold = Order::where('event_id', $event->id)->sum('quantity');
        $sum = Order::where('event_id', $event->id)->sum('grand_total');
        $orders = Order::where('event_id', $event->id)
        ->select('event_id', DB::raw('count(*) as total,created_at'))
        ->groupBy('event_id', 'created_at')->get();

        $paid_out = $sum * (5 / 100);
        $net = $sum - $paid_out;
        $response = [
            'orders' => $orders,
            'sold' => $sold,
            'net' => $net,
            'sum' => $sum,
            'paid_out' => $paid_out,
        ];

        return response($response, 200);
    }
}
