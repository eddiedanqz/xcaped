<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Actions\CreateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\Profile;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    use ImageUploader;

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
    public function store(
        CreateEventRequest $request,
        CreateEvent $createEvent): JsonResponse
    {
        $createEvent->execute($request->validated());

        return response()->json('Success', 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event): JsonResponse
    {
        $user = User::findOrFail($event->user_id);
        $follows = auth()->user()->following->contains('id', $event->user_id) ?? false;
        $saved = auth()->user()->interest->contains('id', $event->id) ?? false;

        $ids = $event->invitations->pluck('user_id')->toArray();

        $invitees = Profile::findOrFail($ids)->take(3);

        return response()->json([
            'event' => EventResource::make($event),
            'invitees' => $invitees,
            'follows' => $follows,
            'saved' => $saved,
            'profile' => $user->profile->profilePhoto,
        ], 200);
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

        return EventResource::make($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return response()->json(['message' => 'Event updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event): JsonResponse
    {
        // delete the Event
        $event->delete();

        return response()->json(['message' => 'Event Deleted']);
    }
}
