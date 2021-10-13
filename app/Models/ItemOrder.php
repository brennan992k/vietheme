<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function OrderItem()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function review_item()
    {
        return $this->hasMany(Review::class, 'user_id', 'user_id');
    }

    public function ItemNotify()
    {
        return $this->belongsTo(ItemUpdateNotify::class, 'item_id', 'item_id');
    }
}
