<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tickets = Ticket::with('event')->all();

        return response()->json($tickets, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tickets = json_decode($request->tickets);
        $event_id = $request->id;

        collect($tickets)->each(function ($item) use ($event_id) {
            $ticket = new Ticket;
            $ticket->title = $item->title;
            $ticket->price = $item->price;
            $ticket->capacity = $item->capacity;
            $ticket->event_id = $event_id;
            $ticket->save();
        });

        return response(['message' => 'Ticket Created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id): JsonResponse
    {
        $ticket = Ticket::where('event_id', $id)->get();

        return response()->json($ticket, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket): JsonResponse
    {
        $ticket->update($request->validated());

        return response()->json(['message' => 'Ticket Updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }
}
