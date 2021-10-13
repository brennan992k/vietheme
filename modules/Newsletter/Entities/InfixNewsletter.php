<?php

namespace Modules\Newsletter\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixNewsletter extends Model
{
    protected $table = 'infix_newsletter';
    protected $primaryKey = 'id';
    protected $fillable = [];
}
