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
        $attendees = Attendee::where('event_id',$event->id)->paginate(10);
        return AttendeeResource::collection($attendees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request)
    {

    $attendee = Attendee::where('id',$request->id)->where('event_id',$request->eventId)
        ->update(['status' => 'checked', 'check_time' => Carbon::now()->format('H:i')]);

    return response($attendee);
    }


}
