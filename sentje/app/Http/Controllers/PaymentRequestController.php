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
    public function create($name)

    {
        dd($name);    
        $user = Auth::user();
        $account = PaymentAccount::Where('user_id', Auth::user()->id)->first();
        return view('paymentrequests.create', compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
                'amount' => 'required|numeric|between:0.01,50000.00'
            ]
            );

            dd($request->get('accountId'));


       $payment_request = new PaymentRequest(
           [
                'payment_account_id' => $request->get('accountId'),
                'amount' => $request->get('amount'),
                'description' => $request->get('description')

           ]
       );

        if($payment_request) {

            $payment_request->save();
            return redirect('/paymentaccounts')->with('success', 'Uw betaalverzoek is aangemaakt');
        }

        return redirect()->back()->with('failed', 'Er is iets fout gegaan. Probeer het opnieuw!');
    
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
