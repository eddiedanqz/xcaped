<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\ImageUploader;
use App\Http\Resources\EventResource;
<<<<<<< HEAD
use App\Services\StoreEventService;
use App\Services\UpdateEventService;
use App\Services\CreateTicketService;
use App\Actions\GetDistanceAction;
use Stevebauman\Location\Facades\Location;
use Illuminate\Database\Eloquent\ModelNotFoundException;
=======
use App\Http\Requests\CreateEventRequest;
use Carbon\Carbon;

>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

class EventController extends Controller
{  use  ImageUploader;

    public function __construct()
    {
<<<<<<< HEAD
        $this->middleware(['auth']);
=======
        $this->middleware('auth');
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function index(GetDistanceAction $getDistanceAction)
    {
        $gip = Location::get($_SERVER['REMOTE_ADDR']);
       // $lat = $gip->latitude;
       // $lng = $gip->longitude;

        $distance = $getDistanceAction->execute();

        $events = Event::select('*')->nearby($distance)->orderBy('distance')->published()
        ->offset(0)->paginate(10);
=======
    public function index()
    {
        $events = Event::latest()->paginate(10);
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

        return EventResource::collection($events);
    }

    /**
<<<<<<< HEAD
=======
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function store(Request $request,StoreEventService $storeEventService)
    {
        $event =  $storeEventService->store($request);
        //create Ticket
        if ($request->has('tickets')) {
            $ticketService = new CreateTicketService();
            $ticketService->create($event,$request->tickets);
        }

=======
    public function store(Request $request)
    {
        $user = auth()->user();

        //handle image upload
         if ($request->hasFile('image'))
          {
         $name = $request->file('image')->store('/images/uploads','public');
         $nameArray = explode("/", $name);
         $filename = array_pop($nameArray);
        }

        $event = new Event;
        $event->title = $request->title;
        $event->slug =Str::slug($request->title).time();
        $event->category_id = $request->category_id;
        $event->description = $request->description;
        $event->banner = $request->hasFile('image') ? $filename :'';
        $event->start_time = $request->start_time;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->venue = $request->venue;
        $event->user_id = $user->id;
        $event->author = $user->username;
        // return $event;
        $event->save();

>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
        return response($event,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
<<<<<<< HEAD
        $user = User::findOrFail($event->user_id);
        $follows = (auth()->user()) ? auth()->user()->following->contains('id',$event->user_id) : false;
        $saved = (auth()->user()) ? auth()->user()->interest->contains('id',$event->id) : false;

        return  response([
            'event' => EventResource::make($event),
            'follows' => $follows,
            'saved' => $saved,
            'profile' => $user->profile->profilePhoto
        ]);
=======
        return  response($event);
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $event = Event::findOrFail($id);
<<<<<<< HEAD
        return  EventResource::make($event);
=======
        return  response($event);
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function update(Request $request,UpdateEventService $updateEventService, $id)
    {
        try {
            $updateEventService->update($request,$id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
=======
    public function update(Request $request,  $id)
    {
        $user = auth()->user();

        if ($request->hasFile('image'))
        {
         $name = $request->file('image')->store('/images/uploads','public');
         $nameArray = explode("/", $name);
         $filename = array_pop($nameArray);
        }

        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->slug =Str::slug($request->title).time();
        $event->category_id = $request->category_id;
        $event->description = $request->description;
        $event->banner = $request->hasFile('image') ? $filename : $event->banner;
        $event->start_time = $request->start_time;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->venue = $request->venue;
        // return $event;
        $event->save();

>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
        return response()->json(['message' => 'Event updated'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $slug)
    {
        //$event = $slug

        // delete the Event
        $slug->delete();

        return ['message' => 'Event Deleted'];
    }
}
