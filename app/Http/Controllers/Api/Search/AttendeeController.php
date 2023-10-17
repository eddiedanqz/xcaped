<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->term;
        $id = $request->eventId;

        $attendees = Attendee::where('event_id', $id)
                ->where('fullname', 'Like', '%'.$search.'%')
                ->orWhere('reference', 'Like', '%'.$search.'%')
                ->paginate(10)->appends(['term' => $search, 'eventId' => $id]);

        return  AttendeeResource::collection($attendees);
    }
    //
}
