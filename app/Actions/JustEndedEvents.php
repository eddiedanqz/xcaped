<?php

namespace App\Actions;

use App\Models\Event;
use App\Enums\EventStatus;
use Illuminate\Support\Facades\DB;

final class JustEndedEvents
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
    public function execute()
    {
        DB::transaction(function () {
            //
            $events = Event::whereHas('status', EventStatus::PUBLISHED->value)->where(function ($query) {
                // Add a condition to filter events that have ended
                $query->where(function ($query) {
                    $query->whereDate('end_date', '<', now()->toDateString());
                })->orWhere(function ($query) {
                    $query->whereDate('end_date', '=', now()->toDateString())
                        ->whereTime('end_time', '<', now()->toTimeString());
                });
            })->get();
            //
            $events->each(function ($event) {
                // Perform your update operations here, for example:
                $event->update(['status_id' => EventStatus::PAST->value]);
            });
        });

    }
}
