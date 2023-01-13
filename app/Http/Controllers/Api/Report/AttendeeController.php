<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;
use App\Http\Resources\AttendeeResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    public function checkin(Request $request)
    {
        $request = json_decode($request->id);
        try {

            $attendee = Attendee::where('id',$request->id)->where('reference',$request->reference)
            ->where('status','pending')->whereNull('check_time')->firstOrFail();
            //
            $eventId = $attendee->event_id;
            $this->authorize('update', [$attendee, $eventId]);
            //
            $attendee->status = 'checked';
            $attendee->check_time = Carbon::now()->format('H:i');
            $attendee->save();
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Ticket already scanned or Not found'], 404);
        }

    return AttendeeResource::make($attendee);
    }


}
