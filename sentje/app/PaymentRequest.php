<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $table = 'payment_requests';

    static function get_all_owned($owner_id) {
        $payment_accounts = PaymentAccount::where('owner_id', $owner_id)->get();
        $payment_requests = [];
        foreach($payment_accounts as $account) {
            $account_requests = PaymentRequest::where('payment_account_id', $account->id)->get();
            foreach($account_requests as $payment_request) {
                $payment_requests[] = $payment_request;   
            }
        }
        return $payment_requests;
    }

    static function get_all_on_account($owner_id, $account_id) {
        $owned_requests = PaymentRequest::get_all_owned($owner_id);
        $account_requests = [];
        foreach($owned_requests as $owned_request) {
            if($owned_request->payment_account_id == $account_id) {
                $account_requests[] = $owned_request;
            }
        }
        return $account_requests;
    }
}
