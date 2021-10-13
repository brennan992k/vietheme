<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSubCategory extends Model
{
    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id', 'id');
    }

    public function CountItem($category, $sub = null)
    {
        if (isset($sub) && isset($category)) {
            $data = Item::where('category_id', $category)->where('sub_category_id', $sub)->where('active_status', 1)->where('status', 1)->count();
            return $data;
        }
    }
}
