<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{  use ImageUploader;

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
          $follows = (auth()->user()) ? auth()->user()->following->contains('id',$user->id) : false;

          $savedCount = Cache::remember(
              'count.events.' . $user->id,
              now()->addSeconds(30),
              function () use ($user) {
                  return $user->interest->count();
              });

          $followersCount = Cache::remember(
              'count.followers.' . $user->id,
              now()->addSeconds(30),
              function () use ($user) {
                  return $user->profile->followers->count();
              });

          $followingCount = Cache::remember(
              'count.following.' . $user->id,
              now()->addSeconds(30),
              function () use ($user) {
                  return $user->following->count();
              });

        return response(['user'=> $user,'events' => $events,'savedCount' => $savedCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(Request $request)
    {
        $user = auth()->user();


        $name = $request->file('image')->store('/images/user','public');
        $nameArray = explode("/", $name);
        $filename = array_pop($nameArray);

        $currentPhoto = $user->profile->profilePhoto;
        //if user already has image delete it
        $userPhoto = public_path('storage/image/user/').$currentPhoto;

        Storage::delete($userPhoto);
        if(file_exists($userPhoto)){
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
    public function update(Request $request)
    {
         //
         $user = auth()->user();

         $this->validate($request,[
            'fullname' => ['required', 'string', 'max:255'],
             'username' => ['required', 'string', 'max:191', 'unique:users,username,'.$user->id],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
         ]);

         $user->update($request->all());
         $user->profile->update($request->all());

         return UserResource::make($user);
    }

    public function updatePassword(Request $request)
     {

        $user = auth()->user();

        $this->validate($request,[
            'password' => ['required', 'string', 'min:6'],
        ]);

        //if password not empty
        if(!empty($request->password)){
            $user->update(['password' => Hash::make($request['password'])]);
        }

        return ['message' => "Success"];
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
