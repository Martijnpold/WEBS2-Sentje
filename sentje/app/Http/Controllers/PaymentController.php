<?php

namespace App\Http\Controllers;

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
        if($request == null) return redirect()->route('home');
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
        $id = $request['request_id'];
        $name = $request['name'];
        $currency = $request['currency'];

        $payment = new Payment;
        $payment->name = $name;
        $payment->payment_request_id = $id;
        $payment->paid = false;
        $payment->save();

        echo $payment;
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
