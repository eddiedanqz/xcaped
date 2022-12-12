<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['auth:sanctum']], function () {


    //User
Route::get('/user', function (Request $request) {
    return $request->user();
});

//Event
Route::get('/events', 'Api\Event\EventController@index');
Route::post('/event/create', 'Api\Event\EventController@store');
Route::post('/event/{id}', 'Api\Event\EventController@update');
Route::get('/event/edit/{id}', 'Api\Event\EventController@edit');
Route::get('/event/show/{id}', 'Api\Event\EventController@show');
Route::delete('/event/delete/{id}', 'Api\Event\EventController@destroy');
Route::get('/my-events', 'Api\User\MyEventController@index');
//Ticket
Route::post('/ticket','Api\Event\TicketController@store');
Route::post('/ticket/{id}','Api\Event\TicketController@update');
Route::get('/event/ticket/{id}','Api\Event\TicketController@edit');

Route::get('/search','Api\Search\SearchController@search');
Route::get('/categories','Api\Category\CategoryController@index');

Route::post('/profile/photo/update','Api\User\UserController@updatePhoto');
Route::post('/profile/update','Api\User\UserController@update');
Route::post('/profile/password/','Api\User\UserController@updatePassword');
Route::get('/profile','Api\User\UserController@index');

//follow user
Route::post('/follow/{user}/' , 'User\FollowsController@_invoke');
//interested event
Route::post('/interested/{event}/' , 'User\InterestedController@_invoke');
//
Route::post('/ifInterested/{event}/' , 'User\InterestedController@check');

Route::post('/verify/slug','Api\Event\SlugCheckerController@index');
//Logout
Route::post('/logout', 'Api\Auth\AuthController@logout');

});

//Auth
Route::post('/register', 'Api\Auth\AuthController@register');
Route::post('/login', 'Api\Auth\AuthController@login');
