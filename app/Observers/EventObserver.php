<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\EventStatus;
use Illuminate\Support\Str;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     *
     * @return void
     */
    public function created(Event $event)
    {

    }

    /**
     * Handle the event "creating" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function creating(Event $event)
    {
        // $event->user_id = auth()->user()->id;
        $event->slug = Str::slug($event->title).time();

        $status = EventStatus::where('slug', 'pending')->first();
        $event->status_id = $status->id;

    }

    /**
     * Handle the Event "updating" event.
     *
     * @return void
     */
    public function updating(Event $event)
    {
        $event->slug = Str::slug($event->title).time();

    }

    /**
     * Handle the Event "deleted" event.
     *
     * @return void
     */
    public function deleted(Event $event)
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     *
     * @return void
     */
    public function restored(Event $event)
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Event $event)
    {
        //
    }
}
