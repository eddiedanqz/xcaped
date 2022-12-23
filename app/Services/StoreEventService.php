<?php
namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Str;

class StoreEventService {

    public function store($request)
    {
        $user = auth()->user();

        //handle image upload
         if ($request->hasFile('image'))
          {
         $name = $request->file('image')->store('/images/uploads','public');
         $nameArray = explode("/", $name);
         $filename = array_pop($nameArray);
        }

        $event = new Event;
        $event->title = $request->title;
        $event->slug =Str::slug($request->title).time();
        $event->category_id = $request->category_id;
        $event->description = $request->description;
        $event->banner = $request->hasFile('image') ? $filename :'';
        $event->start_time = $request->start_time;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->venue = $request->venue;
        $event->address = $request->address;
        $event->address_latitude = $request->lat;
        $event->address_longitude = $request->lon;
        $event->user_id = $user->id;
        $event->author = $user->username;
        $event->save();

         return $event;
    }
}
?>
