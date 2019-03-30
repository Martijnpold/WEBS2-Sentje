<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $table = 'payment_requests';

    protected $fillable = ['payment_account_id', 'amount', 'mollieId', 'description'];

    public $timestamps = true;

    public function payment_account() {
        return $this->belongsTo('App\PaymentAccount')->first();
    }

    public function payments() {
        return $this->hasMany('App\Payment')->get();
    }

    public function can_be_removed() {
        return sizeof($this->payments()) == 0;
    }

    
}
