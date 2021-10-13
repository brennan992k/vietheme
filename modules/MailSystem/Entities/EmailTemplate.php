<?php

namespace Modules\MailSystem\Entities;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'rating',
        'registration',
        'product_purchase',
        'mail_verify',
        'product_refund',
        'product_update',
        'user_suspend',
        'product_comment',
        'product_review_by_buyer',
        'product_expiring_support',
        'daily_summary'
    ];
}
