<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Models\Event;
use App\Enums\EventStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventStatusController extends Controller
{
    public function __invoke(Request $request)
    {

        $event = Event::findOrFail($request['id']);
        $event->update(['status_id' => EventStatus::PUBLISHED->value]);

        return response('Event Published', 201);
    }
}
