<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetController;
use App\Http\Controllers\Api\V1\Event\EventController;
use App\Http\Controllers\Api\V1\Event\EventStatusController;
use App\Http\Controllers\APi\V1\Home\CategoryEventController;
use App\Http\Controllers\Api\V1\Home\HomeController;
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

//Auth

Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/password-reset', [PasswordResetController::class, '__invoke']);
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'v1'], function () {
    //User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/explore', [HomeController::class, 'index']);
    Route::get('/nearby', [HomeController::class, 'nearby']);
    Route::get('/live', [HomeController::class, 'live']);
    Route::get('/events/following', [HomeController::class, 'following']);
    Route::get('/events/following/{id}', [HomeController::class, 'calendar']);

    Route::get('/category/event/{id}', [CategoryEventController::class, '__invoke']);

    //Event
    Route::controller(EventController::class)->group(function () {
        Route::get('/events', 'index');
        Route::post('/event/create', 'store');
        Route::put('/event/{event}', 'update');
        Route::get('/event/edit/{event}', 'edit');
        Route::get('/event/{event}', 'show');
        Route::delete('/event/delete/{event}', 'destroy');
    });

    Route::controller(EventStatusController::class)->group(function () {
        Route::post('/publish/event', 'invoke');
    });
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
    Route::get('/profile/users', 'Api\User\FollowController@people');

    //follow user
    Route::post('/follow/{user}/', 'Api\User\FollowController@index');
    Route::get('/followers/search', 'Api\Search\FollowersController@search');
    Route::get('/followers/', 'Api\User\FollowController@followers');
    Route::get('/account/fans/{id}', 'Api\User\FollowController@people');

    //
    //Route::get('/', '@create');
    Route::apiResources(['withdrawal' => 'Api\User\PaymentDetailController']);

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
    //Notification
    Route::get('/notifications/', 'Api\Notification\UserNotificationController@index');
    Route::get('/notifications/read', 'Api\Notification\UserNotificationController@read');
    Route::delete('/notifications/{uuid}', 'Api\Notification\UserNotificationController@delete');
    //Invites
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
