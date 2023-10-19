<?php

namespace App\Http\Controllers\APi\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class CategoryEventController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $events = Event::where('category_id', $id)->upcoming()
        ->paginate(10);

        return EventResource::collection($events);
    }
}
