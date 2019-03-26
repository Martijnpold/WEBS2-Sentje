<?php

namespace App\Http\Controllers;

use Mollie\Api\MollieApiClient;
use Mollie\Api\Types\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $payment->name = encrypt($name);
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
            "method" => PaymentMethod::CREDITCARD,
            "description" => "Order #{$payment->id}",
            "redirectUrl" => "http://" . env('NGROK_ID', 'NGROK_ID_NOT_FOUND') . ".ngrok.io/home?order_id={$payment->id}", //replaced with the ngrok link
            "webhookUrl" => "http://" . env('NGROK_ID', 'NGROK_ID_NOT_FOUND') . ".ngrok.io/update_payment_status", //replaced with the ngrok link
            "metadata" => [
            "order_id" => $payment->id,
        ],
        ]);
        
        return redirect($mollie_payment->getCheckoutUrl());
    }

    /**
     * Update the specified resource in storage when mollie status changes.
     */
    public function update()
    {
        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_KEY'));
        $mollie_payment = $mollie->payments->get($_POST["id"]);
        $orderId = $mollie_payment->metadata->order_id;
        $payment = Payment::where('id', $orderId)->first();
    
        if($payment != null) {
            $request = PaymentRequest::where('id', $payment->payment_request_id)->first();
            $account = PaymentAccount::where('id', $request->payment_account_id)->first();

            $was_paid = $payment->paid;
            $payment->paid = $mollie_payment->isPaid();
            $payment->save();

            if ($mollie_payment->isPaid()) {
                if(!$was_paid) {
                    $account->balance = $account->balance + $request->amount;
                    $account->save();
                }
            }
        }
        
        return "Success";
    }
}
