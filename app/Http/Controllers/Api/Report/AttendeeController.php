<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;
use App\Http\Resources\AttendeeResource;
use Carbon\Carbon;

class AttendeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $attendees = Attendee::where('event_id',$event->id)->latest()->paginate(10);
        return AttendeeResource::collection($attendees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request, Attendee $attendee)
    {
        $attendee = Attendee::findOrFail($request->id);
        $eventId = $attendee->event_id;

        $this->authorize('update', [$attendee, $eventId]);

        $attendee->status = 'checked';
        $attendee->check_time = Carbon::now()->format('H:i');
        $attendee->save();

    return AttendeeResource::make($attendee);
    }


}
