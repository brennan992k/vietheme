<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title', 'feature1', 'feature2', 'description', 'thumdnail', 'theme_preview', 'main_file', 'file', 'category_id', 'resolution', 'widget', 'compatible_browsers', 'compatible_with', 'framework', 'software_version', 'Re_item',
        'Re_buyer', 'Reg_total', 'E_item', 'E_buyer', 'Ex_total', 'user_msg', 'active_status'
    ];

    public function subCategory()
    {
        return $this->hasOne(ItemSubCategory::class, 'id', 'sub_category_id');
    }

    public function category()
    {
        return $this->HasOne(ItemCategory::class, 'id', 'category_id');
    }

    public function _compatible_browsers()
    {
        return $this->HasOne(SubAttribute::class, 'id', 'compatible_browsers');
    }

    public function _compatible_with()
    {
        return $this->HasOne(SubAttribute::class, 'id', 'compatible_with');
    }

    public function _framework()
    {
        return $this->HasOne(SubAttribute::class, 'id', 'framework');
    }

    public function _software_version()
    {
        return $this->HasOne(SubAttribute::class, 'id', 'software_version');
    }

    public function item_image()
    {
        return $this->hasOne(ItemImage::class, 'item_id', 'id')->where('type', 'theme_preview');
    }
    public function screen_image()
    {
        return $this->hasOne(ItemImage::class, 'item_id', 'id')->where('type', 'screen_shot');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function freeItem()
    {
        return $this->hasOne(FreeItem::class, 'item_id');
    }

    public function attribute()
    {
        return $this->hasMany(ItemAttribute::class, 'item_id');
    }

    public function CountItem($category = null, $sub = null)
    {
        if (isset($sub) && isset($category)) {
            $data = Item::where('category_id', $category)->where('sub_category_id', $sub)->where('active_status', 1)->where('status', 1)->count();
            return $data;
        }
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'item_id', 'id')->whereNull('parent_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'item_id', 'id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'item_id', 'id');
    }

    public function item_fee()
    {
        return $this->hasOne(ItemFee::class, 'category_id', 'category_id');
    }
}
