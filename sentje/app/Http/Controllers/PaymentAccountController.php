<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentAccount;
use App\PaymentRequest;

class PaymentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $payment_accounts = $user->payment_accounts();
        return view('paymentaccounts.index', ['payment_accounts' => $payment_accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('paymentaccounts/create');
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
                'name' => 'required',
                'balance' => 'required|numeric|min:0.00'
            ]
            );


       $payment_account = new PaymentAccount(
           [
                'user_id' => Auth::user()->id,
                'name' => $request->get('name'),
                'balance' => $request->get('balance')

           ]
       );

        if($payment_account) {

            $payment_account->save();
            return redirect('/paymentaccounts')->with('success', 'Uw account is aangemaakt');
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
        $payment_account = $user->payment_accounts()->where('id', $id)->first();
        // dd($payment_account->id);
        $payment_requests = $payment_account->payment_requests();
        return view('paymentaccounts.show', ['payment_account' => $payment_account, 'payment_requests' => $payment_requests]);
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
        
        $payment_account = PaymentAccount::find($id);
        
        if($payment_account != null && $payment_account->user()->id == $user->id) {
            
                $payment_account->delete();
            
        }
        
        return redirect()->back();
    }
}
