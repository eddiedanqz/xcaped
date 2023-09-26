<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request['query'];

        $followers = auth()->user()->profile->followers()
        ->whereHas('profile', function ($query) use ($searchTerm) {
            $query->where('fullname', 'like', '%'.$searchTerm.'%')
            ->orWhere('username', 'like', '%'.$searchTerm.'%');
        })
        ->get();

        return UserResource::collection($followers);
    }
}
