<?php

namespace Modules\Systemsetting\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixCurrency extends Model
{
    protected $table = 'infix_currencies'; 
    protected $primaryKey = 'id';
    protected $fillable = [];
}
