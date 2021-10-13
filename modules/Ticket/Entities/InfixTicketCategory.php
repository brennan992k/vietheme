<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixTicketCategory extends Model
{
    protected $table = 'infix_ticket_categories';
    protected $primaryKey = 'id';
    protected $fillable = [];
}
