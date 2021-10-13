<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemFee extends Model
{
    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id', 'id');
    }
}
