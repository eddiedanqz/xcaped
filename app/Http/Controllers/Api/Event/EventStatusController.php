<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventStatus;
use Illuminate\Http\Request;

class EventStatusController extends Controller
{
    public function __invoke(Request $request)
    {
        $status = EventStatus::where('slug', $request['slug'])->first();

        $event = Event::findOrFail($request['id']);
        $event->update(['status_id' => $status->id]);

        return response('Event Published', 201);
    }
}
