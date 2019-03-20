<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $table = 'payment_requests';

    public function payment_account() {
        return $this->belongsTo('App\PaymentAccount')->get();
    }

    public function payments() {
        return $this->hasMany('App\Payment')->get();
    }

    public function can_be_removed() {
        return sizeof($this->payments()) == 0;
    }
}
