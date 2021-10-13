<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSetting extends Model
{

    public function category()
    {
        return $this->HasOne(ItemCategory::class, 'id', 'item_category_id');
    }
}
