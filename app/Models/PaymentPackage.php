<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentPackage extends Model
{
    protected $fillable = [
        'user_id', 'charge_id', 'stripe_id', 'package_plan', 'amount'
    ];
}
