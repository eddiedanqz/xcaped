<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FollowController extends Controller
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
    public function index(User $user): JsonResponse
    {
        $action = auth()->user()->following()->toggle($user->profile);

        return response()->json($action, 201);
    }

    public function followers()
    {
        $user = auth()->user()->profile->followers;

        return UserResource::collection($user);
    }

    public function people($id)
    {
        $user = User::find($id);
        $followers = $user->profile->followers()->paginate(10);
        $following = $user->following()->paginate(10);

        return ['following' => UserResource::collection($followers),
            'followers' => UserResource::collection($followers)];
    }
}
