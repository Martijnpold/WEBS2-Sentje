<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    public function name() {
        return decrypt($this->name);
    }

    public function datetime() {
        return strtotime($this->created_at);
    }
    
    public function payment_request() {
        return $this->belongsTo('App\PaymentRequest')->first();
    }
}
