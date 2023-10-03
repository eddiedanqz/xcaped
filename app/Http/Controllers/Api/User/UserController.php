<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Http\Request;
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
    public function index($id)
    {
        $user = User::find($id);
        $query = $user->events()->paginate(3);

        $events = EventResource::collection($query);

        //checks if auth user is following $user
        $follows = (auth()->user()) ? auth()->user()->following->contains('id', $user->id) : false;

        $savedCount = $user->interest->count();

        $followersCount = $user->profile->followers->count();

        $followingCount = $user->following->count();

        return response(['user' => $user, 'events' => $events, 'savedCount' => $savedCount, 'follows' => $follows,
            'followers' => $followersCount, 'following' => $followingCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(Request $request)
    {
        $user = auth()->user();

        $name = $request->file('image')->store('/images/user', 'public');
        $nameArray = explode('/', $name);
        $filename = array_pop($nameArray);

        $currentPhoto = $user->profile->profilePhoto;
        //if user already has image delete it
        $userPhoto = public_path('storage/image/user/').$currentPhoto;

        Storage::delete($userPhoto);
        if (file_exists($userPhoto)) {
            @unlink($userPhoto);
        }

        $user->profile->update(['profilePhoto' => $filename]);

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
    public function updatePassword(UserPasswordRequest $request)
    {
        $user = auth()->user();

        //if password not empty
        if (Hash::check($request->OldPassword, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
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
