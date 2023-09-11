<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Event::class, ['title', 'venue'])
            ->registerModel(User::class, ['fullname', 'username'])
            ->limitAspectResults(30)
            ->search($request['query']);

        return $searchResults;
    }
}
