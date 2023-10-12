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
    Route::post('/ticket', 'Api\Event\TicketController@store');
    Route::post('/ticket/{id}', 'Api\Event\TicketController@update');
    Route::get('/event/ticket/{id}', 'Api\Event\TicketController@edit');

    Route::get('/search', 'Api\Search\SearchController@search');
    Route::get('/categories', 'Api\Category\CategoryController@index');

    Route::post('/profile/photo/update', 'Api\User\UserController@updatePhoto');
    Route::post('/profile/update', 'Api\User\UserController@update');
    Route::post('/profile/password/', 'Api\User\UserController@updatePassword');
    Route::get('/profile/{user}', 'Api\User\UserController@index');

    //follow user
    Route::post('/follow/{user}/', 'Api\User\FollowController@index');
    Route::get('/followers/search', 'Api\Search\FollowersController@search');
    Route::get('/followers/', 'Api\User\FollowController@followers');
    //interested event
    Route::get('/event/saved', 'Api\Event\SaveEventController@index');
    Route::post('/event/save/{event}', 'Api\Event\SaveEventController@store');
//
    Route::post('/order', 'Api\Event\OrderController@store');
    Route::post('/update/order/{id}', 'Api\Event\OrderController@update');

    Route::get('/my-tickets', 'Api\Ticket\MyTicketController@index');
    Route::get('/my-ticket/{id}', 'Api\Ticket\MyTicketController@show');
    Route::post('/ticket/share/{attendee}', 'Api\Ticket\MyTicketController@update');
//
    Route::get('/attendees/{event}', 'Api\Report\AttendeeController@index');
    Route::post('/attendee/checkin/', 'Api\Report\AttendeeController@checkin')->name('checkin');
    Route::get('/report/{event}', 'Api\Report\DashboardController@index');
    Route::get('/search/attendee/', 'Api\Search\AttendeeController@search');
    //
    Route::get('/notifications/', 'Api\Notification\UserNotificationController@index');
    Route::get('/notifications/read', 'Api\Notification\UserNotificationController@read');
    //
    Route::get('/invitations/all/', 'Api\Event\InvitationsController@index');
    Route::post('/invitations/send/', 'Api\Event\InvitationsController@store');
    Route::post('/invitations/undo/', 'Api\Event\InvitationsController@undo');

    //Place
    Route::apiResources(['place' => 'Api\Place\PlaceController']);
    Route::apiResources(['promotion' => 'Api\Place\PromotionController']);
    //Payment
    Route::get('/payment/callback', 'Api\Payment\PaymentController@handleGatewayCallback');
    // Route::post('/pay/', 'Api\Payment\PaymentController@redirectToGateway')->name('pay');
    //Logout
    Route::post('/logout', 'Api\Auth\AuthController@logout');
});

//Auth
Route::post('/register', 'Api\Auth\AuthController@register');
Route::post('/login', 'Api\Auth\AuthController@login')->name('login');
Route::post('/password-reset', 'Api\Auth\PasswordResetController@__invoke')->name('login');
