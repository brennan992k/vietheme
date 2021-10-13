<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpnCity extends Model
{
    public function state(){
        return $this->belongsTo(SpnState::class, 'state_id');
    }
}
