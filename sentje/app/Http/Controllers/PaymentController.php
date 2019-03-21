<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentAccount;
use App\PaymentRequest;

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
        echo "Id " . $request['request_id'];
        echo "<br>";
        echo "Name " . $request['name'];
        echo "<br>";
        echo "Selected Currency " . $request['currency'];
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
