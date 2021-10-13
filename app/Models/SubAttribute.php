<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubAttribute extends Model
{
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attributes_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id', 'id');
    }
}
