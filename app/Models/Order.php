<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function itemOrder()
    {
        return $this->hasMany(ItemOrder::class);
    }
}
