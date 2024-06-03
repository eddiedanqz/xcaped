<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;


class ReactionsController extends Controller
{
    public function toggle(Event $event, Request $request)
    {
        $event->toggleReaction($request->reaction);
    }
}
