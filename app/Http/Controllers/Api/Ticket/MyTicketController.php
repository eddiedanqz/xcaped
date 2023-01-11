<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Attendee;
use App\Http\Resources\AttendeeResource;
use Illuminate\Support\Facades\Cache;

class MyTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $myticket = Attendee::where('user_id',$user->id)->latest()->paginate(10);
        return AttendeeResource::collection($myticket);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $myticket = Attendee::where('user_id',$user->id)->findOrFail($id);
        return AttendeeResource::make($myticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Attendee $attendee,Request $request)
    {
        $user = auth()->user();
        $attendee->update(['user_id' => $request->id]);
        return response(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
