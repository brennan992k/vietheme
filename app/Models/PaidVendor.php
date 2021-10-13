<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PaidVendor extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'user_id', 'id');
    }
}
