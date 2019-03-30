<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentAccount;
use App\PaymentRequest;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\Types\PaymentMethod;

class PaymentRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $payment_requests = $user->payment_requests();
        return view('paymentrequests.index', ['payment_requests' => $payment_requests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('paymentrequests.create');
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
        if($name == null) $name = "Anonymous";

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $payment_requests = $user->payment_requests();
        foreach($payment_requests as $payment_request) {
            if($payment_request->id == $id) {
                return view('paymentrequests.show', ['payment_request' => $payment_request, 'payments' => $payment_request->payments()]);
            }
        }
        return redirect('payments');
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $request = PaymentRequest::find($id);
        if($request != null && $request->payment_account()->first()->user()->first()->id == $user->id) {
            if(sizeof($request->first()->payments()) == 0) { 
                $request->delete();
            }
        }
        return redirect()->route('paymentaccounts.index');
    }
}
