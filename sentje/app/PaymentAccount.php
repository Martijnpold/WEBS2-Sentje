<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    protected $table = 'payment_accounts';

    public function user() {
        return $this->belongsTo('App\User')->get();
    }

    public function payment_requests() {
        return $this->hasMany('App\PaymentRequest')->get();
    }
}
