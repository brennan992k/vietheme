<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemCounter extends Model
{
    public static function countByCategoryTag($category, $tag)
    {
        $number = DB::table('items')->where('category_id', @$category)->where('tags', 'LIKE', '%' . @$tag . '%')->get()->count();

        return $number;
    }

    public static function countByTag($tag)
    {
        $number = DB::table('items')->where('tags', 'LIKE', '%' . @$tag . '%')->get()->count();

        return $number;
    }

    public static function getCatSlag($tag)
    {
        $Cat_slug = DB::table('items')->where('tags', 'LIKE', '%' . @$val . '%')->first();
        $_cat_slug = DB::table('item_categories')->find(@$Cat_slug->category_id);

        return $_cat_slug;
    }

    public static function ItemCount($dbc1, $dbc_v, $dbc2 = null, $dbc2_v = null)

    {
        $software_version = DB::table('items')->where('category_id', @$data['category']->id)->where('software_version', @$item->software_version)->get()->count();

        return $software_version;
    }
}
