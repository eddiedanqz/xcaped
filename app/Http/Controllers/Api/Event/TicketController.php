<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\ModelNotFoundException;
=======


>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

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
    public function store(Request $request)
    {
       $tickets = json_decode($request->tickets);
<<<<<<< HEAD
       $event_id = $request->id;

        //   return $tickets;
        //    foreach ($tickets as $req) {
        //         $ticket = new Ticket;
        //         $ticket->title = $req->title;
        //         $ticket->price = $req->price;
        //         $ticket->capacity = $req->capacity;
        //         $ticket->event_id = $event_id;
        //         $ticket->save();
        //     }

        collect($tickets)->each(function ($item) use ( $event_id)
        {
            $ticket = new Ticket;
            $ticket->title = $item->title;
            $ticket->price = $item->price;
            $ticket->capacity = $item->capacity;
            $ticket->event_id = $event_id;
            $ticket->save();
        });
=======
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
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

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
<<<<<<< HEAD

     try {
=======
     //    return $event_id;

        //    return $tickets;
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
        foreach ($tickets as $req) {
             $ticket = Ticket::findOrFail($req->id);
             $ticket->title = $req->title;
             $ticket->price = $req->price;
             $ticket->capacity = $req->capacity;
             $ticket->save();
         }
<<<<<<< HEAD
     }catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Ticket doesn\'t exist'], 404);
        }
=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

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
<<<<<<< HEAD

        return response(['message'=>'Deleted'],200);
=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    }
}
