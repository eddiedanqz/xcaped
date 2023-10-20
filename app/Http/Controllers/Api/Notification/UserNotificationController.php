<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use DB;

class UserNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->notifications()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return auth()->user()->notifications;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->user()->notifications()->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('notifications')
        ->where('id', $id)
        ->delete();

        return response('Deleted', 201);
    }
}
