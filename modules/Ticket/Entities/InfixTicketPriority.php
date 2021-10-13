<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixTicketPriority extends Model
{
    protected $table = 'infix_ticket_priorities';
    protected $primaryKey = 'id';
    protected $fillable = [];
}
