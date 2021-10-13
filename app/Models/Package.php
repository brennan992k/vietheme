<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function packageType()
    {
        return $this->belongsTo(PackageType::class, 'package_type', 'id');
    }
}
