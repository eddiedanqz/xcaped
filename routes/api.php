<?php

use App\Http\Controllers\Api\User\MyEventController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetController;
use App\Http\Controllers\Api\V1\Event\EventController;
use App\Http\Controllers\Api\V1\Event\EventStatusController;
use App\Http\Controllers\Api\V1\Event\OrderController;
use App\Http\Controllers\Api\V1\Event\SaveEventController;
use App\Http\Controllers\Api\V1\Event\TicketController;
use App\Http\Controllers\APi\V1\Home\CategoryEventController;
use App\Http\Controllers\Api\V1\Home\HomeController;
use App\Http\Controllers\Api\V1\Notification\UserNotificationController;
use App\Http\Controllers\Api\V1\Payment\PaymentController;
use App\Http\Controllers\Api\V1\Report\AttendeeController;
use App\Http\Controllers\Api\V1\Report\DashboardController;
use App\Http\Controllers\Api\V1\Search\FollowersController;
use App\Http\Controllers\Api\V1\Search\SearchController;
use App\Http\Controllers\Api\V1\Ticket\MyTicketController;
use App\Http\Controllers\Api\V1\User\FollowController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\Withdrawal\PaymentMethodController;
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

    Route::controller(HomeController::class)->group(function () {
        Route::get('/explore', 'index');
        Route::get('/nearby', 'nearby');
        Route::get('/live', 'live');
        Route::get('/events/following', 'following');
        Route::get('/events/following/{id}', 'calendar');
    });

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

    Route::controller(MyEventController::class)->group(function () {
        Route::get('/my-events', 'index');
    });

    //Ticket
    Route::controller(TicketController::class)->group(function () {
        Route::post('/ticket', 'store');
        Route::put('/ticket/{ticket}', 'update');
        Route::get('/ticket/{id}', '@edit');
    });

    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'search');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('/profile/photo/update', 'updatePhoto');
        Route::post('/profile/update', 'update');
        Route::post('/profile/password/', 'updatePassword');
        Route::get('/profile/{user}', 'index');
    });

    //follow user
    Route::controller(FollowController::class)->group(function () {
        //   Route::get('/profile/users', 'Api\User\FollowController@people');
        Route::post('/follow/{user}/', 'Api\User\FollowController@index');
        Route::get('/followers/', 'Api\User\FollowController@followers');
        Route::get('/account/fans/{id}', 'Api\User\FollowController@people');
    });

    Route::controller(FollowersController::class)->group(function () {
        Route::get('/followers/search', 'search');
    });
    //
    Route::apiResources(['withdrawal' => 'Api\User\PaymentDetailController']);

    //Interested event
    Route::controller(SaveEventController::class)->group(function () {
        Route::get('/event/saved', 'index');
        Route::post('/event/save/{event}', 'store');
    });

    //Order
    Route::controller(OrderController::class)->group(function () {
        Route::post('/order', 'store');
        Route::post('/update/order/{id}', 'update');
    });

    Route::controller(MyTicketController::class)->group(function () {
        Route::get('/my-tickets', 'index');
        Route::get('/my-ticket/{id}', 'show');
        Route::post('/ticket/share/{attendee}', 'update');
    });

    //
    Route::controller(AttendeeController::class)->group(function () {
        Route::get('/attendees/{event}', 'index');
        Route::post('/attendee/checkin/', 'checkin')->name('checkin');
    });

    //
    Route::controller(AttendeeSearchController::class)->group(function () {
        Route::get('/search/attendee/', 'search');
    });

    //
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/report/{event}', '@index');
    });

    //Notification
    Route::controller(UserNotificationController::class)->group(function () {
        Route::get('/notifications/', 'index');
        Route::get('/notifications/read', 'read');
        Route::delete('/notifications/{uuid}', 'delete');
    });

    //Invites
    Route::get('/invitations/all/', 'Api\Event\InvitationsController@index');
    Route::post('/invitations/send/', 'Api\Event\InvitationsController@store');
    Route::post('/invitations/undo/', 'Api\Event\InvitationsController@undo');

    //Place
    Route::apiResources(['place' => 'Api\Place\PlaceController']);
    Route::apiResources(['promotion' => 'Api\Place\PromotionController']);

    //Payment
    Route::controller(PaymentMethodController::class)->group(function () {
        Route::get('/settings/payments', 'index');
        Route::post('/settings/payments', 'store');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::get('/payment/callback', 'handleGatewayCallback');
        // Route::post('/pay/', 'Api\Payment\PaymentController@redirectToGateway')->name('pay');
    });

    //Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
