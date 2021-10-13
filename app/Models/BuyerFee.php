<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerFee extends Model
{
    public function buyerFeetype()
    {
        return $this->belongsTo(BuyerFeeType::class, 'type', 'id');
    }

    public function AuthorName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
