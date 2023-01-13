<?php
namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateEventService {

    public function update($request,$id)
    {

        $user = auth()->user();

        if ($request->hasFile('image'))
        {
         $name = $request->file('image')->store('/images/uploads','public');
         $nameArray = explode("/", $name);
         $filename = array_pop($nameArray);
        }

        $event = Event::find($id);
        if (!$event) {
          throw new ModelNotFoundException("Event does not exist.");
        }

        $event->title = $request->title;
        $event->slug =Str::slug($request->title).time();
        $event->type = $request->type;
        $event->category_id = $request->category_id;
        $event->description = $request->description;
        $event->banner = $request->hasFile('image') ? $filename : $event->banner;
        $event->start_time = $request->start_time;
        $event->start_date = $request->start_date;
        $event->end_time = $request->end_time;
        $event->end_date = $request->end_date;
        $event->venue = $request->venue;
        $event->address = $request->address;
        $event->address_latitude = $request->lat;
        $event->address_longitude = $request->lon;
        $event->save();

    }
}
?>
