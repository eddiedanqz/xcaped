<?php

namespace App\Actions;

use App\Models\Event;
use App\Models\EventStatus;
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
            $past = EventStatus::where('slug', 'past')->first();
            //
            $events = Event::whereHas('status', function ($query) {
                $query->where('slug', 'published');
            })->where(function ($query) {
                // Add a condition to filter events that have ended
                $query->where(function ($query) {
                    $query->whereDate('end_date', '<', now()->toDateString());
                })->orWhere(function ($query) {
                    $query->whereDate('end_date', '=', now()->toDateString())
                        ->whereTime('end_time', '<', now()->toTimeString());
                });
            })->get();
            //
            $events->each(function ($event) use ($past) {
                // Perform your update operations here, for example:
                $event->update(['status_id' => $past->id]);
            });
        });

    }
}
