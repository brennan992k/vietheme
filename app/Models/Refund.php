<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Refund\Entities\RefundReason;

class Refund extends Model
{
    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function RefundReason()
    {
        return $this->belongsTo(RefundReason::class, 'ref_id', 'id');
    }

    function itemOrder()
    {
        return $this->belongsTo(ItemOrder::class, 'item_id', 'item_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function refundComment()
    {
        return $this->hasMany(RefundComment::class, 'item_id', 'item_id');
    }
}
