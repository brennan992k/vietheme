<?php

namespace App\Models;

use App\Models\ItemSubCategory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public function subCategory()
    {
        return $this->hasMany(ItemSubCategory::class, 'item_category_id', 'id');
    }
    public function productSetting()
    {
        return $this->hasOne(ProductSetting::class, 'item_category_id', 'id');
    }
    public function ItemSubCategory()
    {
        return $this->belongsTo(ItemSubCategory::class, 'id', 'item_category_id');
    }
}
