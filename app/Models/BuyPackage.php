<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyPackage extends Model
{
    public function packageType()
    {
        return $this->belongsTo(PackageType::class, 'package_plan', 'id');
    }
}
