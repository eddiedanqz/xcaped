<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     *
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $data = [
            'amount' => $request['grand_total'] * 100,
            'reference' => paystack()->genTranxRef(),
            'email' => auth()->user()->email,
            'currency' => 'GHS',
            'metadata' => [
                'orderID' => $request['id'],
            ],
        ];

        return Paystack::getAuthorizationUrl($data)->redirectNow();
        // try {
        //     return Paystack::getAuthorizationUrl($request)->redirectNow();
        // } catch(\Exception $e) {
        //     return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        // }
    }

    /**
     * Obtain Paystack payment information
     *
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        return $paymentDetails;
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // update order status
    }
}
