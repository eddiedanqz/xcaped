<?php

namespace App\Http\Controllers\Api\Home;

use App\Actions\GetDistanceAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\FollowerResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $gip = Location::get('102.176.94.250');
        // $lat = $gip->latitude;
        // $lng = $gip->longitude;
        // $city = $gip->cityName;

        $getDistanceAction = new GetDistanceAction;
        $distance = $getDistanceAction->execute();

        $user = auth()->user();
        $events = Event::select('*')->nearby($distance)->orderBy('distance')
        ->offset(0);

        $published = $events //upcoming()->published()
          ->paginate(10);

        $live = $events->ongoing()->paginate(10);

        $followerIds = $user->following->pluck('id')->toArray();

        $following = Event::with('user')->upcoming()
               ->withEventCount($followerIds)
               ->paginate(10);

        //return $following = Event::with('user')->whereIn('user_id', $user->following->pluck('id'))->paginate(10);

        return [
            'following' => FollowerResource::collection($following),
            'live' => EventResource::collection($live),
            'events' => EventResource::collection($published),
        ];
    }

    public function nearby()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $gip = Location::get('102.176.94.250');
        // $lat = $gip->latitude;
        // $lng = $gip->longitude;
        // $city = $gip->cityName;

        $getDistanceAction = new GetDistanceAction;
        $distance = $getDistanceAction->execute();

        $user = auth()->user();
        $events = Event::select('*')->nearby($distance)->orderBy('distance')
        ->offset(0);

        $published = $events //upcoming()->published()
          ->paginate(10);

        return EventResource::collection($published);
    }

    public function live()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $gip = Location::get('102.176.94.250');
        // $lat = $gip->latitude;
        // $lng = $gip->longitude;
        // $city = $gip->cityName;

        $getDistanceAction = new GetDistanceAction;
        $distance = $getDistanceAction->execute();

        $user = auth()->user();
        $events = Event::select('*')->nearby($distance)->orderBy('distance')
        ->offset(0);

        $published = $events //upcoming()->published()
          ->paginate(10);

        $live = $events->ongoing()->paginate(10);

        return EventResource::collection($live);
    }

    public function following()
    {
        $user = auth()->user();
        $followerIds = $user->following->pluck('id')->toArray();

        $following = Event::with('user')->upcoming()
               ->withEventCount($followerIds)
               ->paginate(10);

        return FollowerResource::collection($following);
    }

    public function calendar($id)
    {
        $events = Event::with('user')->where('user_id', $id)->upcoming()
        ->get();

        return EventResource::collection($events);
    }
}
