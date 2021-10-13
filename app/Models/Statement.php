<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
