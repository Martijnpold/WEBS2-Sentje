<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentAccount;
use App\PaymentRequest;

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
        //
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
        return redirect()->back();
    }
}
