<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;



class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::with('event')->all();
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
       $tickets = json_decode($request->tickets);
       $event_id = json_decode($request->id);
    //    return $event_id;

       //    return $tickets;
       foreach ($tickets as $req) {
            $ticket = new Ticket;
            $ticket->title = $req->title;
            $ticket->price = $req->price;
            $ticket->capacity = $req->capacity;
            $ticket->event_id = $event_id;
            $ticket->save();
        }

        return response(['message'=>'Ticket Created'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::where('event_id',$id)->get();

        return response($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tickets = json_decode($request->tickets);
     //    return $event_id;

        //    return $tickets;
        foreach ($tickets as $req) {
             $ticket = Ticket::findOrFail($req->id);
             $ticket->title = $req->title;
             $ticket->price = $req->price;
             $ticket->capacity = $req->capacity;
             $ticket->save();
         }

         return response(['message'=>'Ticket Updated'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }
}
