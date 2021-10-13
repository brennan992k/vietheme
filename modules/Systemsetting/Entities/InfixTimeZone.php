<?php

namespace Modules\Systemsetting\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixTimeZone extends Model
{
    protected $table = 'infix_time_zones'; 
    protected $primaryKey = 'id';
    protected $fillable = [];
}
