<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\User;
use App\Http\Resources\UserResource;
=======
use App\User;
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4


class FollowController extends Controller
{
    public function __construct()
    {
<<<<<<< HEAD
        $this->middleware(['auth']);
=======
        $this->middleware(['auth','verified']);
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function index(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }

    public function followers()
    {
        $user = auth()->user()->profile->followers;
        return UserResource::collection($user);
    }
=======
    public function __invoke(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
}
