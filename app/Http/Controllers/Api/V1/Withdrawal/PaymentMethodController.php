<?php

namespace App\Http\Controllers\Api\V1\Withdrawal;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentDetailRequest;
use App\Traits\CreateRecipient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentMethodController extends Controller
{
    use CreateRecipient;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $settings = auth()->user()->settings;

        return response()->json($settings, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        //fetch list of telcos/bank
        return $this->getList();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentDetailRequest $request): JsonResponse
    {
        $user = auth()->user();
        $data = $request->validated();

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'settings->payment_details->payment_method' => $data['payment_method'],
                'settings->payment_details->phone_number' => $data['phone_number'],
                'settings->payment_details->bank_name' => $data['bank_name'],
                'settings->payment_details->account_number' => $data['account_number'],
                'settings->payment_details->bank_code' => $request->bank_code,
            ]);

        return response()->json('Saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = auth()->user();

        $settings = $user->settings;
        $settings->put('theme', 'dark');
        $user->settings = $settings;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
