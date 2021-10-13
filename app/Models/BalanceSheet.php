<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceSheet extends Model
{

    function GetUser()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
