<?php

namespace Modules\Tax\Entities;

use App\Models\SpnCountry;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [];

    public function country()
    {
        return $this->hasOne(SpnCountry::class, 'id', 'country_id');
    }
}
