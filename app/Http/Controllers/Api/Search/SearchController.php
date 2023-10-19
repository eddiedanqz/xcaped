<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // return $request;

        $searchResults = (new Search())
            ->registerModel(Event::class, function (ModelSearchAspect $modelSearchAspect) use ($request) {
                $modelSearchAspect
                ->addSearchableAttribute('title')
                ->addSearchableAttribute('venue')
                   //->published()
                   ->where('venue', 'Like', '%'.$request['venue'].'%')
                   ->where('category_id', 'Like', '%'.$request['category'].'%')
                   ->dateFilter($request['date'])
                   ->with('category');
            })
                ->registerModel(User::class, function (ModelSearchAspect $modelSearchAspect) {
                    $modelSearchAspect
                    ->addSearchableAttribute('fullname')
                    ->addSearchableAttribute('username')
                    ->with('profile');
                })
            ->limitAspectResults(30)
            ->search($request['query']);

        return $searchResults;
    }
}
