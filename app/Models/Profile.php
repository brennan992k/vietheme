<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function country()
    {
        return $this->hasOne(SpnCountry::class, 'id', 'country_id');
    }

    public function state()
    {
        return $this->hasOne(SpnState::class, 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne(SpnCity::class, 'id', 'city_id');
    }
}
