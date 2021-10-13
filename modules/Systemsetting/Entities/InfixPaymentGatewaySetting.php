<?php

namespace Modules\Systemsetting\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixPaymentGatewaySetting extends Model
{
    protected $table = 'infix_payment_gateway_settings'; 
    protected $primaryKey = 'id';
    protected $fillable = ['gateway_name','gateway_configur', 'active_status'];
}
