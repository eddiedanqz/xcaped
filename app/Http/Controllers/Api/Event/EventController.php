<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\ImageUploader;
use App\Http\Resources\EventResource;
use App\Http\Requests\CreateEventRequest;
use Carbon\Carbon;


class EventController extends Controller
{  use  ImageUploader;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);

        return EventResource::collection($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return  response($event);
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
        return  response($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
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
