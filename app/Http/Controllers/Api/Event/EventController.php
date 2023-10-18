<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\Profile;
use App\Models\User;
use App\Services\CreateTicketService;
use App\Services\StoreEventService;
use App\Services\UpdateEventService;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use  ImageUploader;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreEventService $storeEventService)
    {
        $event = $storeEventService->store($request);
        //create Ticket
        if ($request->has('tickets')) {
            $ticketService = new CreateTicketService();
            $ticketService->create($event, $request->tickets);
        }

        return response($event, 201);
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
        $user = User::findOrFail($event->user_id);
        $follows = (auth()->user()) ? auth()->user()->following->contains('id', $event->user_id) : false;
        $saved = (auth()->user()) ? auth()->user()->interest->contains('id', $event->id) : false;

        $ids = $event->invitations->pluck('user_id')->toArray();

        $invitees = Profile::findOrFail($ids)->take(3);

        return  response([
            'event' => EventResource::make($event),
            'invitees' => $invitees,
            'follows' => $follows,
            'saved' => $saved,
            'profile' => $user->profile->profilePhoto,
        ]);
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

        return  EventResource::make($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UpdateEventService $updateEventService, $id)
    {
        try {
            $updateEventService->update($request, $id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        return response()->json(['message' => 'Event updated'], 201);
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
