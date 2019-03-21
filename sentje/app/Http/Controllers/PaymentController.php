<?php

namespace App\Http\Controllers;

use Mollie\Api\MollieApiClient;
use Mollie\Api\Types\PaymentMethod;
use Illuminate\Http\Request;
use App\PaymentAccount;
use App\PaymentRequest;
use App\Payment;

class PaymentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = PaymentRequest::where('id', $id)->first();
        if($request == null) return redirect('/');
        return view('payment.show', ['payment_request' => $request]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_id = $request->request_id;
        $payment_request = PaymentRequest::where('id', $request_id)->first();
        if($payment_request == null) return redirect('/');
        $name = $request->name;
        $currency = $request->currency;

        $payment = new Payment;
        $payment->name = $name;
        $payment->payment_request_id = $request_id;
        $payment->paid = false;
        $payment->save();

        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_KEY'));
        $mollie_payment = $mollie->payments->create([
            "amount" => [
                "currency" => $currency,
                "value" => number_format($payment_request->amount, 2)
            ],
            "method" => PaymentMethod::IDEAL,
            "description" => "Order #{$payment->id}",
            "redirectUrl" => "http://" . env('NGROK_ID', 'NGROK_ID_NOT_FOUND') . ".ngrok.io//03-return-page.php?order_id={$payment->id}", //replaced with the ngrok link
            "webhookUrl" => "http://" . env('NGROK_ID', 'NGROK_ID_NOT_FOUND') . ".ngrok.io/02-webhook-verification.php", //replaced with the ngrok link
            "metadata" => [
            "order_id" => $payment->id,
        ],
        ]);
        
        header("Location: " . $payment->getCheckoutUrl(), true, 303);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
