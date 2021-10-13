<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Tax\Entities\Tax;

class SpnCountry extends Model
{
    public function tax(){
    	return $this->hasOne(Tax::class, 'country_id', 'id');
    }
}
