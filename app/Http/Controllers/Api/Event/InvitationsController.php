<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use App\Notifications\SendInvite;
use Illuminate\Http\Request;

class InvitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::where('user_id', auth()->user()->id)
        ->paginate(10);

        return response($invitations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invitation = new Invitation;
        $invitation->title = $request->title;
        $invitation->banner = $request->banner;
        $invitation->event_id = $request->eventId;
        $invitation->user_id = $request->id;
        $invitation->save();

        //Send notification
        $details = [
            'title' => $invitation->id,
            'body' => 'You have a new event invitation',
        ];
        $user = User::findOrFail($invitation->user_id);
        $user->notify(new SendInvite($details));

        return response($invitation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function undo(Request $request)
    {
        $invitation = Invitation::findOrFail($request->id);
        $invitation->delete();

        return response('Done', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();

        return response('Deleted', 200);
    }
}
