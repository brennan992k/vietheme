<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPayment extends Model
{
    protected $fillable =[
        'user_id','charge_id','stripe_id','item_id','amount','type'
    ];
}
