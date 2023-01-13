<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{

    public function login(LoginUserRequest $request)
    {

     //Check username
    $user =  User::where('username', $request['username'])
           ->orWhere('email',$request['email'])->first();

    //Check Password
    if(!$user || !Hash::check($request['password'], $user->password)){
        return response([
            'message' => 'Invalid Credentials'
        ], 401);
    }

    $token = $user->createToken('xcoken')->plainTextToken;
    $authUser = UserResource::make($user);

    $response =  [
      'user' => $authUser,
      'token' => $token,
    ];

    return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request)
    {
        //
        $user =  User::create([
            'username' => $request['username'],
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        //$user->assignRole('Customer');

        $token = $user->createToken('xcoken')->plainTextToken;
        $authUser = UserResource::make($user);

        $response =  [
          'user' => $authUser,
          'token' => $token,
        ];

        return response($response,201);

    }

    /**
    * Log Out
    */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out',
          ];

    }
}
