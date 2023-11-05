<?php

namespace App\Actions;

use App\Models\Withdrawal;

final class getEndedEvents
{
    /**
     * Get events that just ended
     *
     * Get events that just ended for withdrawal
     *
     * @param  \App\Models\Event  $event
     * @return type
     *
     * @throws conditon
     **/
    public function execute($events)
    {
        //user settings
        //site settings
        //user gross and net amount
        //order details

        //
        $events->each(function ($event) {
            // Perform your update operations here, for example:
            $withdrawal = new Withdrawal;
        });

        return $events;
    }
}
