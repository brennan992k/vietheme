<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPreview extends Model
{
    protected $fillable = ['status'];

    public function subCategory()
    {
        return $this->belongsTo(ItemSubCategory::class, 'sub_category_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id', 'id');
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
        return $this->HasOne(ItemImage::class, 'item_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function item_fee()
    {
        return $this->hasOne(ItemFee::class, 'category_id', 'category_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
