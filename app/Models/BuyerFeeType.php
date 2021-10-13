<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerFeeType extends Model
{
    public function buyerFee()
    {
        return $this->hasMany(BuyerFee::class, 'type');
    }
}
