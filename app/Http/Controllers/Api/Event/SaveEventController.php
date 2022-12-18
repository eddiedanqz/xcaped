<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

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
    public function index(Event $event)
    {
        return auth()->user()->interest()->toggle($event);
    }
}
