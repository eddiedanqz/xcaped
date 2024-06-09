<?php

namespace App\Http\Controllers\Api\V1\Withdrawal;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentDetailRequest;
use App\Traits\CreateRecipient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        if ($data['settings']['payment_method'] === 'Mobile Money') {
            $user->setSetting('payment_method', $data['settings']['payment_method']);
            $user->setSetting('payment_details.phone_number', $data['settings']['payment_details']['phone_number'],
            );
        } else {
            $user->setSetting($key, $value);
        }

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
