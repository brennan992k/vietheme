<?php

namespace Modules\Ticket\Entities;

use App\Models\SmNotification;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\HumanResource\Entities\InfixDepartment;

class InfixTicket extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'category_id',
        'priority_id'
    ];

    public function ticket_category()
    {
        return $this->belongsTo(InfixTicketCategory::class, 'category_id');
    }

    public function ticket_priority()
    {
        return $this->belongsTo(InfixTicketPriority::class, 'priority_id');
    }

    public function ticket_comment()
    {
        return $this->belongsTo(InfixTicketComment::class, 'comment_id');
    }

    public function ticket_department()
    {
        return $this->belongsTo(InfixDepartment::class, 'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'user_agent');
    }

    public function notification()
    {
        return $this->hasMany(SmNotification::class, 'ticket_id');
    }
}
