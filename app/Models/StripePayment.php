<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model
{
    protected $fillable =[
        'amount','user_id','charge_id','stripe_id','quantity'
    ];
}
