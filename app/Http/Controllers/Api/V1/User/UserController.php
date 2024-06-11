<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ImageUploader;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user): JsonResponse
    {
        $query = $user->events()->paginate(3);

        $events = EventResource::collection($query);

        //checks if auth user is following $user
        $follows = (auth()->user()) ? auth()->user()->following->contains('id', $user->id) : false;

        $eventCount = $user->events->count();

        $followersCount = $user->profile->followers->count();

        $followingCount = $user->following->count();

        return response()->json(['user' => $user, 'events' => $events, 'eventCount' => $eventCount, 'follows' => $follows,
            'followers' => $followersCount, 'following' => $followingCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(UpdateImageRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        $user->profile
            ->getFirstMedia('avatar')
            ?->delete();

        $user->profile->addMedia($data['image'])
            ->toMediaCollection('avatar');

        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        //
        $user = auth()->user();

        $user->update($request->all());
        $user->profile->update($request->all());

        return UserResource::make($user);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        //if password not empty
        if ($request['password']) {
            $user->update(['password' => Hash::make($request['password'])]);
        }

        return ['message' => 'Password Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete account
        $user = User::find($id);
        $user->delete();

        return response()->json('Account Deleted', 200);
    }
}
