<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function subAttribute()
    {
        return $this->hasMany(SubAttribute::class, 'attributes_id');
    }
}
