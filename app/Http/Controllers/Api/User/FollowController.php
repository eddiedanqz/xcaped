<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
