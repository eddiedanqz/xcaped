<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SlugCheckerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $request =  json_decode($request->getContent());
        $slug = Str::slug($request);
        $data = new Request();
        $data->replace(['slug' => $slug,
    ]);

    $this->Validate($data, [
        'slug' => ['string','max:191','unique:events'],
    ]);

    return response(['message' => 'Event name accepted']);
    }
}
