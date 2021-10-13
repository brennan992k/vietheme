<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotificationSettings extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->where(['status' => 1, 'access_status' => 1]);
    }
}
