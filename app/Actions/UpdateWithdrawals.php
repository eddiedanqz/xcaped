<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\User;
use App\Models\Withdrawal;
use App\Settings\GeneralSettings;

final class UpdateWithdrawals
{
    /**
     * Get events that just ended
     *
     * Get events that just ended for withdrawal
     *
     * @param  \App\Models\Withdrawal
     * @return type
     *
     * @throws conditon
     **/
    public function execute($events)
    {
        //
        $events->each(function ($event) {
            //user settings
            $user = User::find($event->user_id);
            $method = $user->getSetting('payment_method');
            $details = $user->getSetting('payment_details');

            $rate = app(GeneralSettings::class)->commission;

            $gross = Order::where('event_id', $event->id)->sum('grand_total');
            $commission = $gross * ($rate / 100);
            $net = $gross - $commission;

            // Perform your update operations here, for example:
            Withdrawal::create([
                'order_no' => paystack()->genTranxRef(),
                'organizer' => $event->author,
                'event_id' => $event->id,
                'event_status' => $event->status,
                'method' => $method,
                'details' => $details,
                'commission' => $rate,
                'amount' => $gross,
                'actual_amount' => $net,
                'ended_at' => $event->end_date,
            ]);

        });
    }
}
