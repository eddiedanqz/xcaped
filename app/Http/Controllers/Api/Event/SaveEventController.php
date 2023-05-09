<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
<<<<<<< HEAD
use App\Http\Resources\EventResource;

=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

class SaveEventController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function index()
    {
        return EventResource::collection(auth()->user()->interest);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event)
    {
        return auth()->user()->interest()->toggle($event);
=======
    public function __invoke(Event $event)
    {
        return auth()->user()->interests()->toggle($event);
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    }
}
