<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\EventStatus;
use Illuminate\Support\Facades\Log;
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
        Log::info('Creating event fired for YourModel.');
        // $event->user_id = auth()->user()->id;
        $event->slug = Str::slug($event->title);

        $status = EventStatus::where('slug', 'pending')->first();
        $event->status_id = $status->id;

    }

    /**
     * Handle the Event "updated" event.
     *
     * @return void
     */
    public function updated(Event $event)
    {
        //
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
