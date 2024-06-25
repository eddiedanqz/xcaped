<?php

namespace App\Http\Controllers\Api\V1\Withdrawal;

use App\Models\User;
use App\Models\Event;
use App\Models\Order;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Event $event): void
    {
        $user = User::findOrFail($event->user_id);
        $method = $user->settings->get('payment_method');
        $details = $user->settings->get('payment_details');

        $rate = app(GeneralSettings::class)->commission;

        $gross = Order::where('event_id', $event->id)->sum('grand_total');
        $commission = $gross * ($rate / 100);
        $net = $gross - $commission;

        // Perform your update operations here, for example:
        Withdrawal::create([
            'order_no' => paystack()->genTranxRef(),
            'event_id' => $event->id,
            'method' => $method,
            'details' => $details,
            'commission' => $rate,
            'amount' => $gross,
            'actual_amount' => $net,
            'ended_at' => $event->end_date,
            'event_status' => $event->status_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
