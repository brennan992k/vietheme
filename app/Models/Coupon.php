<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Min_Price()
    {
        return $this->hasOne(BuyerFee::class, 'id', 'min_price');
    }
}
