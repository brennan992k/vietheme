<?php

namespace Modules\Systemsetting\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixEmailSetting extends Model
{
    protected $table = 'infix_email_settings'; 
    protected $primaryKey = 'id';
    protected $fillable = [];
}
