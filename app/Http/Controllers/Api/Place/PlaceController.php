<?php

namespace App\Http\Controllers\Api\Place;

use App\Actions\GetDistanceAction;
use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gip = Location::get($_SERVER['REMOTE_ADDR']);
        // $lat = $gip->latitude;
        // $lng = $gip->longitude;
        $getDistanceAction = new GetDistanceAction;
        $distance = $getDistanceAction->execute();

        $places = Place::select('*')->nearby($distance)->orderBy('distance')
        ->offset(0)->paginate(10);

        return $places;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        //handle image upload
        if ($request->hasFile('logo')) {
            $name = $request->file('logo')->store('/images/uploads', 'public');
            $nameArray = explode('/', $name);
            $filename = array_pop($nameArray);
        }

        $isExist = Place::where('user_id', $user->id)->doesntExist();
        if (! $isExist) {
            return response()->json('Cannot add more than one business', 404);
        }

        $place = new Place;
        $place->name = $request->name;
        $place->slug = Str::slug($request->name).time();
        $place->user_id = $user->id;
        $place->logo = $request->hasFile('logo') ? $filename : '';
        $place->address = $request->address;
        $place->address_latitude = $request->latitude;
        $place->address_longitude = $request->longitude;
        $place->phone = $request->phone;
        $place->type_id = $request->typeId;
        $place->start_day = $request->startDay;
        $place->close_day = $request->closeDay;
        $place->start_time = $request->startTime;
        $place->close_time = $request->closeTime;
        $place->save();

        return response()->json($place, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        //handle image upload
        if ($request->hasFile('logo')) {//unlink
            $name = $request->file('logo')->store('/images/uploads', 'public');
            $nameArray = explode('/', $name);
            $filename = array_pop($nameArray);
        }

        $place = Place::find($id);
        if (! $place) {
            throw new ModelNotFoundException('Place does not exist.');
        }

        $place->name = $request->name;
        $place->slug = Str::slug($request->name).time();
        $place->user_id = $user->id;
        $place->logo = $request->hasFile('logo') ? $filename : '';
        $place->address = $request->address;
        $place->address_latitude = $request->latitude;
        $place->address_longitude = $request->longitude;
        $place->phone = $request->phone;
        $place->type_id = $request->typeId;
        $place->start_day = $request->startDay;
        $place->close_day = $request->closeDay;
        $place->start_time = $request->startTime;
        $place->close_time = $request->closeTime;
        $place->save();

        return response()->json($place, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::find($id);
        $place->delete();

        return response()->json('Place deleted', 200);
    }
}
