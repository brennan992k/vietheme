<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ManageQuery extends Model
{
    public static function ItemWithSubCategoryTag($sub_cat_id, $tag)
    {
        return DB::table('items')->where('sub_category_id', $sub_cat_id)->where('tags', 'LIKE', '%' . @$tag . '%')->get()->count();
    }
    public static function ItemWithCategoryTag($cat_id, $tag)
    {
        return DB::table('items')->where('category_id', $cat_id)->where('tags', 'LIKE', '%' . @$tag . '%')->get()->count();
    }


    public static function ItemSaleCountWithSubCat($sub_cat_id)
    {

        $data['no'] = DB::table('items')->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->where('sell', 0)->get()->count();
        $data['low'] = DB::table('items')->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1)->where('sell', '<=', 300)->get()->count();
        $data['medium'] = DB::table('items')->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 300)->where('sell', '<=', 600)->get()->count();
        $data['high'] = DB::table('items')->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 600)->where('sell', '<=', 1000)->get()->count();
        $data['top'] = DB::table('items')->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1000)->get()->count();

        return $data;
    }

    public static function ItemSaleCountWithCat($cat_id)
    {

        $data['no'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->where('sell', 0)->get()->count();
        $data['low'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1)->where('sell', '<=', 300)->get()->count();
        $data['medium'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 300)->where('sell', '<=', 600)->get()->count();
        $data['high'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 600)->where('sell', '<=', 1000)->get()->count();
        $data['top'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1000)->get()->count();

        return $data;
    }

    public static function ItemStarCountWithSubCat($sub_cat_id)
    {

        $data['oneStar'] = DB::table('items')->where('sub_category_id', @$sub_cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 1)->where('rate', '<', 2)->get()->count();
        $data['TwoStar'] = DB::table('items')->where('sub_category_id', @$sub_cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 2)->where('rate', '<', 3)->get()->count();
        $data['ThreStar'] = DB::table('items')->where('sub_category_id', @$sub_cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 3)->where('rate', '<', 4)->get()->count();
        $data['FourStar'] = DB::table('items')->where('sub_category_id', @$sub_cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 4)->where('rate', '<', 5)->get()->count();
        $data['FivStar'] = DB::table('items')->where('sub_category_id', @$sub_cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 5)->get()->count();

        return $data;
    }

    public static function ItemStarCountWithCat($cat_id)
    {

        $data['oneStar'] = DB::table('items')->where('category_id', @$cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 1)->where('rate', '<', 2)->get()->count();
        $data['TwoStar'] = DB::table('items')->where('category_id', @$cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 2)->where('rate', '<', 3)->get()->count();
        $data['ThreStar'] = DB::table('items')->where('category_id', @$cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 3)->where('rate', '<', 4)->get()->count();
        $data['FourStar'] = DB::table('items')->where('category_id', @$cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 4)->where('rate', '<', 5)->get()->count();
        $data['FivStar'] = DB::table('items')->where('category_id', @$cat_id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 5)->get()->count();

        return $data;
    }

    public static function ItemDateWiseWithSubCat($cat_id, $sub_cat_id)
    {

        $data['Any_Date'] = DB::table('items')->where('category_id', $cat_id)->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->count();
        $data['LastYear'] = DB::table('items')->where('category_id', $cat_id)->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d', strtotime('-1 years')))->count();
        $data['Last_month'] = DB::table('items')->where('category_id', $cat_id)->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')])->count();
        $data['Last_week'] = DB::table('items')->where('category_id', $cat_id)->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')])->count();
        $data['Last_day'] = DB::table('items')->where('category_id', $cat_id)->where('sub_category_id', $sub_cat_id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')])->count();
        return $data;
    }

    public static function ItemDateWiseWithCat($cat_id)
    {

        $data['Any_Date'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->count();
        $data['LastYear'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d', strtotime('-1 years')))->count();
        $data['Last_month'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')])->count();
        $data['Last_week'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')])->count();
        $data['Last_day'] = DB::table('items')->where('category_id', $cat_id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')])->count();
        return $data;
    }

    public static function ItemSubCatWithSoftwareVersion($sub_cat_id, $software_version)
    {

        return DB::table('items')->where('sub_category_id', $sub_cat_id)->where('software_version', $software_version)->get()->count();
    }

    public static function ItemCatWithSoftwareVersion($cat_id, $software_version)
    {

        return DB::table('items')->where('category_id', $cat_id)->where('software_version', $software_version)->get()->count();
    }

    public static function ItemCatWithCompatibleWith($cat_id, $compatible_with)
    {

        return DB::table('items')->where('category_id', $cat_id)->where('compatible_with', $compatible_with)->get()->count();
    }

    public static function ItemSubCatWithCompatibleWith($sub_cat_id, $compatible_with)
    {

        return DB::table('items')->where('sub_category_id', $sub_cat_id)->where('compatible_with', $compatible_with)->get()->count();
    }

    public static function InfixTicket()
    {

        $data['progress'] = DB::table('infix_tickets')->where('active_status', 2)->count();
        $data['pending'] = DB::table('infix_tickets')->where('active_status', 0)->count();
        $data['close'] = DB::table('infix_tickets')->where('active_status', 1)->count();

        return $data;
    }

    public static function SiteInageMessage($id)
    {

        return DB::table('infix_background_settings')->where('id', $id)->first();
    }

    public static function GetDemoUser($id)
    {

        return DB::table('users')->where('email_verified_at', '!=', NULL)->where('role_id', $id)->first();
    }

    public static function ReCaptchaSetting()
    {

        return DB::table('re_captcha_settings')->first();
    }

    public static function FindSubAttributes($id)
    {

        return DB::table('sub_attributes')->find($id);
    }

    public static function ItemWithTitelVersion($title, $version)
    {

        return  DB::table('items')->where('title', 'LIKE', '%' . $title . '%')->where('software_version', $version)->get()->count();
    }

    public static function ItemWithTitelCompatible($title, $compatible_with)
    {

        return DB::table('items')->where('title', 'LIKE', '%' . $title . '%')->where('compatible_with', @$compatible_with)->get()->count();
    }

    public static function InfixDepartment()
    {

        return  DB::table('infix_departments')->where('active_status', 1)->get();
    }

    public static function CountItemSell($user_id)
    {

        return  DB::table('items')->where('user_id', $user_id)->sum('sell');
    }
    public static function UserLabel($user_balance)
    {

        return  DB::table('labels')->where('amount', '<=', $user_balance)->orderBy('id', 'desc')->first();
    }
    public static function UserBadge($date)
    {

        return  DB::table('badges')->where('day', '<=', $date)->orderBy('id', 'desc')->first();
    }
    public static function FooterSellCount()
    {
        $data['ItemEarning'] = DB::table('balance_sheets')->sum('income');
        $data['ItemSale'] = DB::table('item_orders')->count();

        return $data;
    }

    public static function SelectedCategoryDetails($id)
    {

        return DB::table('item_categories')->where('id', $id)->first();
    }

    public static function FreeItemOfCategory($id)
    {

        return DB::table('item_fees')->where('category_id', $id)->first();
    }

    public static function UserFirstItem()
    {

        return DB::table('items')->where('user_id', Auth::user()->id)->first();
    }

    public static function CategoryUpPermission()
    {

        return DB::table('item_categories')->where('up_permission', 1)->orderBy('id', 'desc')->get();
    }

    public static function UserEmailNotificationSettings()
    {

        return DB::table('email_notification_settings')->where('user_id', Auth::user()->id)->first();
    }

    public static function UserDetails()
    {

        return DB::table('users')->where('id', '=', Auth::user()->id)->first();
    }

    public static function UserPaymentStatement()
    {
        return DB::table('statements')->where('author_id', Auth::user()->id)->whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get();
    }

    public static function ReviewType()
    {
        return DB::table('review_types')->where('status', 1)->orderBy('id', 'asc')->get();
    }

    public static function BuyerFees($type)
    {
        return DB::table('buyer_fees')->where('type', $type)->first();
    }
}
