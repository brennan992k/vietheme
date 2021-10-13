<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'user_id'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function reviewType()
    {
        return $this->belongsTo(ReviewType::class, 'review_type', 'id');
    }
}
