<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class FollowersController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request['query']; // Replace with your search term

        $followers = User::whereHas('profile.followers', function ($query) use ($searchTerm) {
            // Apply your search criteria here
            $query->where('fullname', 'like', '%'.$searchTerm.'%')
            ->orWhere('username', 'like', '%'.$searchTerm.'%');
        })
        ->get();

        return UserResource::collection($followers);
    }
}
