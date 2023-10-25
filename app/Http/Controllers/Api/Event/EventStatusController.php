<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventStatusController extends Controller
{
    public function __invoke(Request $request)
    {
        $event = Event::findOrFail($request['id']);
        $event->update(['status' => $request['status']]);

        return response('Event Published', 201);
    }
}
