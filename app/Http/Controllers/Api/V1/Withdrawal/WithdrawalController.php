<?php

namespace App\Http\Controllers\Api\V1\Withdrawal;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\Withdrawal;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $user = auth()->user();

        $method = $user->settings['payment_details']['payment_method'];

        $details = $user->settings['payment_details'];

        $event = Event::findOrFail($request->id);

        $rate = app(GeneralSettings::class)->commission;

        $gross = Order::where('event_id', $event->id)->sum('grand_total');
        $commission = $gross * ($rate / 100);
        $net = $gross - $commission;

        // Perform your update operations here, for example:
        Withdrawal::create([
            'order_no' => paystack()->genTranxRef(),
            'event_id' => $event->id,
            'method' => $method,
            'details' => $details,
            'commission' => $rate,
            'amount' => $gross,
            'actual_amount' => $net,
            'ended_at' => $event->end_date,
            'event_status' => $event->status,
        ]);

        return response()->json('Success', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
