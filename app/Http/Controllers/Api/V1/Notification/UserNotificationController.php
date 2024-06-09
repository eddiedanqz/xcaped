<?php

namespace App\Http\Controllers\Api\V1\Notification;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\JsonResponse;

class UserNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $notifications = auth()->user()->notifications()->paginate(10);

        return response()->json($notifications, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function read(): JsonResponse
    {
        auth()->user()->unreadNotifications->markAsRead();

        $notifications = auth()->user()->notifications;

        return response()->json($notifications, 200);
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
