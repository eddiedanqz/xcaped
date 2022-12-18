<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Models\Event;
use App\Http\Resources\EventResource;
use Illuminate\Support\Carbon;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $search = $request;
        // return $search->date;

        $events = new Event;
        $queries = [];
        $columns  = [
            'title', 'venue',
        ];

        //
        foreach( $columns as $column) {
             if ( request()->has($column) && request($column) != null){
                 $events = $events->where('title','Like',"%".request($column)."%")
                 ->orWhere('venue','Like',"%".request($column)."%");
                 $queries[$column] = request($column);
             }
         }

         if($search->category){
            $events = $events->orWhere('category_id',$search->category);
            $queries['category'] = $search->category;
          }

         if($search->date){
            $to = Carbon::parse($search->date);
            $events = $events->orWhereDate('start_date','>=',$search->date);
            $queries['date'] = $search->date;
          }


        $results =  $events->paginate(10)->appends($queries);
        // $results = Event::where(function($query) use ($search){
        //     $query->where('title','LIKE',"%$search->title%");
        // })->paginate(10);

        return EventResource::collection($results);
    }

}
