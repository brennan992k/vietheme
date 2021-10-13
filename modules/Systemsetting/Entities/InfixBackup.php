<?php

namespace Modules\Systemsetting\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixBackup extends Model
{
    protected $table = 'infix_backups'; 
    protected $primaryKey = 'id';
    protected $fillable = [];
}
