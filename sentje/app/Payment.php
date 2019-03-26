<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    
    public function payment_request() {
        return $this->belongsTo('App\PaymentRequest')->first();
    }
}
