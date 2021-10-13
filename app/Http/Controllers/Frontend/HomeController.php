<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
use App\Models\User;
use App\Models\Refund;
use App\Models\Review;
use App\Models\Package;
use App\Models\SpnCity;
use App\Models\BuyerFee;
use App\Models\SpnState;
use App\Models\ItemOrder;
use App\Models\BuyPackage;
use App\Models\SocialIcon;
use App\Models\SpnCountry;
use App\Models\PackageType;
use App\Models\PaidPayment;
use App\Models\ItemCategory;
use App\Models\LicenseFeature;
use App\Models\PaymentPackage;
use App\Models\ItemSubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Pages\Entities\MarketApi;
use Illuminate\Support\Facades\Schema;
use Modules\Pages\Entities\TicketPage;
use Illuminate\Support\Facades\Session;
use Modules\Pages\Entities\LicensePage;
use Modules\Pages\Entities\BecomeAuthor;
use Modules\Ticket\Entities\InfixTicket;
use Modules\Refund\Entities\RefundReason;
use Modules\Pages\Entities\InfixAboutCompany;
use Modules\Pages\Entities\InfixPrivacyPolicy;
use Modules\Pages\Entities\InfixTermCondition;
use Modules\Ticket\Entities\InfixTicketCategory;
use Modules\Ticket\Entities\InfixTicketPriority;
use Modules\KnowledgeBase\Entities\InfixKnowledgeBaseCategory;
use Stripe\Charge;
use Stripe\Stripe;

class HomeController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    function index()
    {
        session()->forget('locale');
        try {
            if (Schema::hasTable('users')) {
                $testInstalled = DB::table('users')->get();
                if (count($testInstalled) < 1) {
                    return view('install.welcome_to_infix');
                } else {

                    $data['category'] =  ItemCategory::where('active_status', 1)->where('show_menu', 1)->get();
                    $data['item'] =  Item::where('active_status', 1)->where('status', 1)->take(2)->get();

                    $free_items_count = DB::table('users')
                        ->leftjoin('items', 'users.id', '=', 'items.user_id')
                        ->leftjoin('free_items', 'items.id', '=', 'free_items.item_id')
                        ->select('items.title', 'items.id as id', 'items.icon', 'users.username as username')
                        ->where('items.status', 1)
                        ->where('items.active_status', 1)
                        ->where('items.free', 1)
                        ->where('free_items.date', date('m'))->count();

                    return view('frontend.home.index', compact('data', 'free_items_count'));
                }
            } else {
                return view('install.welcome_to_infix');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function featureitem()
    {

        $date = \Carbon\Carbon::today()->subDays(7);
        $search = Item::where('active_status', 1)->where('status', 1)->where('created_at', '>=', $date)->orderBy('views', 'desc');
        $data = $search->paginate(10);
        return response()->json($data, 200);
    }

    function itemsearch(Request $request)
    {
        $search = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
            ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_sub_categories.slug as sub_slug', 'item_categories.title as category', 'item_categories.slug as cat_slug')
            ->where('items.status', 1)->where('items.active_status', 1)
            ->where('items.title', 'like', '%' . $request->data . '%')
            ->orWhere('items.id', 'like', '%' . $request->data . '%')
            ->orWhere('items.tags', 'like', '%' . $request->data . '%')
            ->orWhere('items.description', 'like', '%' . $request->data . '%')
            ->orWhere('item_categories.title', 'like', '%' . $request->data . '%')
            ->orWhere('item_sub_categories.title', 'like', '%' . $request->data . '%');

        $data = $search->get();
        return response()->json($data, 200);
    }

    function search(Request $r)
    {
        if ($r->ajax()) {
            $output = '';
            $query = $r->get('search');
            if ($query != '') {
                $data = DB::table('users')
                    ->where('username', 'like', '%' . $query . '%')
                    ->orWhere('verified', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
                return response()->json($data, 200);
            }
        }
    }

    public function homefilter(Request $request)
    {
        $all = '';
        $bestsell = '';
        $newest = '';
        $bestrated = '';
        $trending = '';
        $high = '';
        $low = '';


        if (isset($_GET['all'])) {
            $all = $_GET['all'];
        }
        if (isset($_GET['bestsell'])) {
            $bestsell = $_GET['bestsell'];
        }
        if (isset($_GET['newest'])) {
            $newest = $_GET['newest'];
        }

        if (isset($_GET['bestrated'])) {
            $bestrated = $_GET['bestrated'];
        }
        if (isset($_GET['trending'])) {
            $trending = $_GET['trending'];
        }
        if (isset($_GET['high'])) {
            $high = $_GET['high'];
        }
        if (isset($_GET['low'])) {
            $low = $_GET['low'];
        }


        $search = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
            ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
            ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_categories.title as category', 'item_fees.support_fee')
            ->where('items.status', 1)
            ->where('items.active_status', 1);
        /*  ->where('bestrated','like','%'.$bestrated.'%') */
        /*  ->where('bestsell','like','%'.$bestsell.'%') */
        /*  ->where('trending','like','%'.$trending.'%')  */
        if ($request->bestsell) {
            $search->orderBy('sell', 'desc');
        }
        if ($request->bestrated) {
            $search->orderBy('rate', 'desc');
        }
        if ($request->trending) {
            $search->orderBy('views', 'desc');
        }
        if ($request->newest) {
            $search->orderBy('id', 'DESC');
        }
        if ($low == "low") {
            $search->orderBy('Reg_total', 'asc');
        }
        if ($high == "high") {
            $search->orderBy('Reg_total', 'DESC');
        }

        // return $search->get();
        $data = $search->paginate(8);
        return response()->json($data, 200);
    }

    function SupportTicket()
    {
        try {
            if (Auth::user() != "") {
                $data['ticket_category'] = InfixTicketCategory::latest()->get();
                $data['ticket_priority'] = InfixTicketPriority::latest()->get();
                $ticket = InfixTicket::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
                $ticket_page = TicketPage::where('active_status', 1)->first();
                return view('frontend.pages.support_ticket', compact('data', 'ticket', 'ticket_page'));
            } else {
                return redirect('login');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function profile($username)
    {
        try {
            $data['user'] = User::where('username', $username)->first();
            $data['profile'] = route('user.profile', $data['user']->username);
            $data['socila_icons'] = SocialIcon::where('user_id', $data['user']->id)->first();
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function portfolio($username)
    {
        try {
            $data['user'] = User::where('username', $username)->first();
            $data['portfolio'] = route('user.portfolio', $data['user']->username);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function followers($username)
    {
        try {
            $data['user'] = User::where('username', $username)->first();
            $data['followers'] = route('user.followers', $data['user']->username);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function followings($username)
    {
        try {
            $data['user'] = User::where('username', $username)->first();
            $data['followings'] = route('user.followings', $data['user']->username);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function vendor($data = null)
    {
        try {
            $data['category'] =  ItemCategory::where('active_status', 1)->take(6)->get();
            $data['country'] = SpnCountry::all();
            $data['follower'] = $data['user']->followers()->paginate(6);
            $data['following'] = $data['user']->followings()->paginate(6);
            $data['item'] = Item::where('user_id', $data['user']->id)->where('active_status', 1)->where('status', 1)->paginate(5);
            $data['BuyerFee'] = BuyerFee::where('status', 1)->where('type', 1)->first();
            $data['item_review'] = Review::where('vendor_id',  $data['user']->id)->paginate(6);
            return view('frontend.pages.vendorView', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function license_details()
    {
        try {
            return view('frontend.pages.license_details');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    // start coutry
    public function state($id)
    {
        $state = SpnState::where('country_id', $id)->get();
        return response()->json($state);
    }
    public function city($id)
    {
        $city = SpnCity::where('state_id', $id)->get();
        return response()->json($city);
    }
    // end coutry


    // Cactegoruy wise item 
    function categoryItem($category, $subcategory = null)
    {
        // return $subcategory;
        try {
            $data['category'] = ItemCategory::where('slug', $category)->where('active_status', 1)->first();
            $data['sub_category'] = ItemSubCategory::where('active_status', 1)->where('item_category_id', $data['category']->id)->get();
            //$data['key']=Session::get('key');
            if (isset($subcategory)) {
                $data['subcategory'] = $subcategory;
                $data['sub_cat'] = ItemSubCategory::where('slug', $subcategory)->where('active_status', 1)->first();
                $item = Item::where('category_id', $data['category']->id)->where('sub_category_id', $data['sub_cat']->id)->where('active_status', 1)->where('status', 1);
                $data['item_count'] = $item;
                $data['item'] = $item->paginate(5);
            } else {
                $item = Item::where('category_id', $data['category']->id)->where('active_status', 1)->where('status', 1);
                $data['item_count'] = $item;
                $data['item'] = $item->paginate(5);
            }
            $data = $this->sellWise($data);
            $data = $this->starWise($data);
            $data = $this->dateWise($data);
            return view('frontend.pages.category', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function sellWise($data)
    {
        if (@$data['sub_cat']) {
            $data['no'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', 0)->get()->count();
            $data['low'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1)->where('sell', '<=', 300)->get()->count();
            $data['medium'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 300)->where('sell', '<=', 600)->get()->count();
            $data['high'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 600)->where('sell', '<=', 1000)->get()->count();
            $data['top'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1000)->get()->count();
        } else {
            $data['no'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('sell', 0)->get()->count();
            $data['low'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1)->where('sell', '<=', 300)->get()->count();
            $data['medium'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>', 300)->where('sell', '<=', 600)->get()->count();
            $data['high'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>', 600)->where('sell', '<=', 1000)->get()->count();
            $data['top'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>', 1000)->get()->count();
        }
        return $data;
    }
    function starWise($data)
    {
        if (@$data['sub_cat']) {
            $data['oneStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 1)->where('rate', '<', 2)->get()->count();
            $data['TwoStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 2)->where('rate', '<', 3)->get()->count();
            $data['ThreStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 3)->where('rate', '<', 4)->get()->count();
            $data['FourStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 4)->where('rate', '<', 5)->get()->count();
            $data['FivStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 5)->get()->count();
        } else {
            $data['oneStar'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 1)->where('rate', '<', 2)->get()->count();
            $data['TwoStar'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 2)->where('rate', '<', 3)->get()->count();
            $data['ThreStar'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 3)->where('rate', '<', 4)->get()->count();
            $data['FourStar'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 4)->where('rate', '<', 5)->get()->count();
            $data['FivStar'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 5)->get()->count();
        }
        return $data;
    }
    function dateWise($data)
    {
        if (@$data['sub_cat']) {
            $data['Any_Date'] = DB::table('items')->where('category_id', @$data['category']->id)->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->count();
            $data['LastYear'] = DB::table('items')->where('category_id', @$data['category']->id)->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d', strtotime('-1 years')))->count();
            $data['Last_month'] = DB::table('items')->where('category_id', @$data['category']->id)->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')])->count();
            $data['Last_week'] = DB::table('items')->where('category_id', @$data['category']->id)->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')])->count();
            $data['Last_day'] = DB::table('items')->where('category_id', @$data['category']->id)->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')])->count();
        } else {
            $data['Any_Date'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->count();
            $data['LastYear'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d', strtotime('-1 years')))->count();
            $data['Last_month'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')])->count();
            $data['Last_week'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')])->count();
            $data['Last_day'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')])->count();
        }
        return $data;
    }

    // // Sub ctegoruy wise item 
    function SubCategoryItem($category, $subcategory)
    {
        try {
            $data['category'] = ItemCategory::where('slug', $category)->where('active_status', 1)->first();
            $data['sub_category'] = ItemSubCategory::where('active_status', 1)->where('slug', $subcategory)->first();
            $data['subcategory'] = $subcategory;
            $data['sub_cat'] = ItemSubCategory::where('slug', $subcategory)->where('active_status', 1)->first();
            $item = Item::where('category_id', $data['category']->id)->where('sub_category_id', $data['sub_cat']->id)->where('active_status', 1)->where('status', 1);
            $data['item_count'] = $item;
            $data['item'] = $item->paginate(5);

            $data = $this->sellWise($data);
            $data = $this->starWise($data);
            $data = $this->dateWise($data);

            return view('frontend.pages.category', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function searchCategoryItem($category, $subcategory = null)
    {

        try {
            $data['searCat'] = 1;
            $data['category'] = ItemCategory::where('slug', $category)->where('active_status', 1)->first();
            $data['sub_category'] = ItemSubCategory::where('active_status', 1)->where('item_category_id', $data['category']->id)->get();
            $data['key'] = Session::get('key');
            if (isset($subcategory)) {
                $data['subcategory'] = $subcategory;
                $data['sub_cat'] = ItemSubCategory::where('slug', $subcategory)->where('active_status', 1)->first();
                $item = Item::where('category_id', $data['category']->id)->where('sub_category_id', $data['sub_cat']->id)->where('active_status', 1)->where('status', 1);
                $data['item_count'] = $item;
                $data['item'] = $item->paginate(5);
            } else {
                $item = Item::where('category_id', $data['category']->id)->where('active_status', 1)->where('status', 1);
                $data['item_count'] = $item;
                $data['item'] = $item->paginate(5);
            }
            return view('frontend.pages.category', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function tagCatItem($category, $attribute = null, $tag = null)
    {
        try {
            $data['category'] = ItemCategory::where('slug', $category)->where('active_status', 1)->first();
            $data['sub_category'] = ItemSubCategory::where('active_status', 1)->where('item_category_id', $data['category']->id)->get();
            $data['tag'] = $tag;
            $data['key'] = Session::get('key');
            $data['attribute'] = $attribute;
            $item = Item::where('category_id', $data['category']->id)->where('active_status', 1)->where('status', 1);
            $data['item_count'] = $item->get();
            $data['item'] = $item->paginate(5);
            return view('frontend.pages.tag', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function dateItem($attribute = null, $tag = null)
    {
        try {
            $data['tag'] = $tag;
            $data['key'] = Session::get('key');
            $data['attribute'] = $attribute;
            $itemm = Item::where('items.title', 'like', '%' . @$data['key'] . '%')->where('active_status', 1)->where('status', 1);
            $data['item_count'] = $itemm->get();
            $data['_category_'] = ItemCategory::where('active_status', 1)->get();
            $search = DB::table('users')
                ->leftjoin('items', 'users.id', '=', 'items.user_id')
                ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
                ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
                ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_sub_categories.slug as sub_slug', 'item_categories.title as category', 'item_categories.slug as cat_slug')
                ->where('items.status', 1)->where('items.active_status', 1);

            //    ->orWhere('items.description', 'like', '%'.@$data['key'].'%');
            /*  ->orWhere('item_categories.title', 'like', '%'.@$data['key'].'%')
           ->orWhere('item_sub_categories.title', 'like', '%'.@$data['key'].'%'); */
            if ($data['key']) {
                //$search=$search->where('items.title', 'like', '%'.$data['key'].'%');
            }
            if ($attribute) {
                switch ($attribute) {
                    case 'software_version':
                        if ($tag) {
                            $dat = DB::table('sub_attributes')->where('name', $tag)->first();
                            $search = $search->where('items.software_version', $dat->id);
                        }
                        break;
                    case 'tag':
                        if ($tag) {
                            $search = $search->where('items.tags',  'like', '%' . $tag . '%');
                        }
                        break;
                    case 'tags':
                        if ($tag) {
                            $search = $search->where('items.tags',  'like', '%' . $tag . '%');
                        }
                        break;
                    case 'compatible_with':
                        if ($tag) {
                            $dat = DB::table('sub_attributes')->where('name', $tag)->first();
                            $search = $search->where('items.compatible_with', $dat->id);
                        }
                        break;
                    case 'date':
                        if ($tag) {
                            if ($tag == 'anydate') {
                                $search = $search;
                            } elseif ($tag == 'last_year') {
                                //return response()->json('lol', 200);

                                $search->whereDate('items.created_at', '<=', date('Y-m-d', strtotime('-1 years')));
                            } elseif ($tag == 'last_month') {
                                $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')]);
                            } elseif ($tag == 'last_week') {
                                $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')]);
                            } elseif ($tag == 'last_day') {
                                $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')]);
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
            $data['item'] = $search->get();

            $data = $this->sellWise($data);
            $data = $this->starWise($data);
            $data = $this->dateWise($data);


            return view('frontend.pages.search', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function tagSubItem($category, $subcategory = null, $attribute = null, $tag = null)
    {
        try {
            $data['category'] = ItemCategory::where('slug', $category)->where('active_status', 1)->first();
            $data['sub_category'] = ItemSubCategory::where('active_status', 1)->where('item_category_id', $data['category']->id)->get();
            $data['tag'] = $tag;
            $data['key'] = Session::get('key');
            $data['attribute'] = $attribute;
            // return $data;
            if (isset($subcategory)) {
                $data['subcategory'] = $subcategory;
                $data['sub_cat'] = ItemSubCategory::where('slug', $subcategory)->where('active_status', 1)->first();
                $item = Item::where('category_id', $data['category']->id)
                    ->where('items.tags',  'like', '%' . $tag . '%')
                    ->where('sub_category_id', $data['sub_cat']->id)
                    ->where('active_status', 1)->where('status', 1);
                $data['item_count'] = $item->get();
                $data['item'] = $item->paginate(5);
            } else {
                $item = Item::where('category_id', $data['category']->id)->where('active_status', 1)
                    ->where('items.tags',  'like', '%' . $tag . '%')
                    ->where('status', 1)->paginate(5);
                $data['item_count'] = $item->get();
                $data['item'] = $item->paginate(5);
            }
            // return $data['item_count'];
            // $data=[];
            return view('frontend.pages.tag', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function categoryWiseItem(Request $request)
    {
        $all = '';
        $bestsell = '';
        $newest = '';
        $bestrated = '';
        $trending = '';
        $high = '';
        $low = '';

        if (isset($_GET['all'])) {
            $all = $_GET['all'];
        }
        if (isset($_GET['bestsell'])) {
            $bestsell = $_GET['bestsell'];
        }
        if (isset($_GET['newest'])) {
            $newest = $_GET['newest'];
        }

        if (isset($_GET['bestrated'])) {
            $bestrated = $_GET['bestrated'];
        }
        if (isset($_GET['trending'])) {
            $trending = $_GET['trending'];
        }
        if (isset($_GET['high'])) {
            $high = $_GET['high'];
        }
        if (isset($_GET['low'])) {
            $low = $_GET['low'];
        }
        $search = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
            ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
            ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_categories.title as category', 'item_fees.support_fee')
            ->where('items.status', 1)->where('items.active_status', 1);
        /*  ->where('bestsell','like','%'.$bestsell.'%') */
        /*  ->where('trending','like','%'.$trending.'%')  */
        if ($request->_categor_id) {
            $search = $search->where('items.category_id', $request->_categor_id);
        }
        if ($request->min_price && $request->max_price) {
            $search = $search->whereBetween('items.Reg_total', [$request->min_price, $request->max_price]);
        }
        if ($request->key) {
            $search = $search->where('items.title', 'like', '%' . $request->key . '%');
        }
        if ($request->_subcategor_id) {
            $search = $search->where('item_sub_categories.slug',  $request->_subcategor_id);
        }

        if ($request->newest) {
            $search->orderBy('id', 'DESC');
        }

        if ($low == "low") {
            $search->orderBy('Reg_total', 'asc');
        }
        if ($high == "high") {
            $search->orderBy('Reg_total', 'DESC');
        }
        if ($request->tag) {
            $search = $search->where('items.tags',  $request->_tag);
            //return response()->json($search->get(), 200);
        }
        if ($request->bestsell) {
            $search->orderBy('sell', 'desc');
        }
        if ($request->bestrated) {
            $search->orderBy('rate', 'desc');
        }

        if ($request->trending) {
            $search->orderBy('views', 'desc');
        }
        if ($request->NoSell) {
            $search->where('sell', 0)->get();
        }
        if ($request->LowSell) {
            $search->where('sell', '>=', 1)->where('sell', '<=', 300);
        }
        if ($request->MediumSell) {
            $search->where('sell', '>', 300)->where('sell', '<=', 600);
        }
        if ($request->HighSell) {
            $search->where('sell', '>', 600)->where('sell', '<=', 1000);
        }
        if ($request->TopSell) {
            $search->where('sell', '>', 1000);
        }
        if (@$request->star) {
            switch ($request->star) {
                case 1:
                    $search->where('rate', '>=', 1)->where('rate', '<', 2);
                    break;
                case 2:
                    $search->where('rate', '>=', 2)->where('rate', '<', 3);
                    break;
                case 3:
                    $search->where('rate', '>=', 3)->where('rate', '<', 4);
                    break;
                case 4:
                    $search->where('rate', '>=', 4)->where('rate', '<', 5);
                    break;
                case 5:
                    $search->where('rate', '>=', 5);
                    break;
                default:
                    $search;
                    break;
            }
        }

        $data = $search->paginate(8);
        return response()->json($data, 200);
    }
    public function SearchWiseItem(Request $request)
    {
        $all = '';
        $bestsell = '';
        $newest = '';
        $bestrated = '';
        $trending = '';
        $high = '';
        $low = '';

        if (isset($_GET['all'])) {
            $all = $_GET['all'];
        }
        if (isset($_GET['bestsell'])) {
            $bestsell = $_GET['bestsell'];
        }
        if (isset($_GET['newest'])) {
            $newest = $_GET['newest'];
        }

        if (isset($_GET['bestrated'])) {
            $bestrated = $_GET['bestrated'];
        }
        if (isset($_GET['trending'])) {
            $trending = $_GET['trending'];
        }
        if (isset($_GET['high'])) {
            $high = $_GET['high'];
        }
        if (isset($_GET['low'])) {
            $low = $_GET['low'];
        }
        $search = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
            ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
            ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_categories.title as category', 'item_fees.support_fee')
            ->where('items.status', 1)->where('items.active_status', 1);
        /*  ->where('bestsell','like','%'.$bestsell.'%') */
        /*  ->where('trending','like','%'.$trending.'%')  */
        if ($request->_categor_id) {
            $search = $search->where('items.category_id', $request->_categor_id);
        }
        if ($request->key) {
            $search = $search->Where('items.title', 'like', '%' . $request->key . '%')
                ->orWhere('items.tags', 'like', '%' . $request->key . '%')
                ->orWhere('items.id', 'like', '%' . $request->key . '%');
        }
        if ($request->min_price && $request->max_price) {
            $search = $search->whereBetween('items.Reg_total', [$request->min_price, $request->max_price]);
        }

        if ($request->_subcategor_id) {
            $search = $search->where('item_sub_categories.slug',  $request->_subcategor_id);
        }

        if ($request->newest) {
            $search->orderBy('id', 'DESC');
        }

        if ($low == "low") {
            $search->orderBy('Reg_total', 'asc');
        }
        if ($high == "high") {
            $search->orderBy('Reg_total', 'DESC');
        }
        if ($request->bestsell) {
            $search->orderBy('sell', 'desc');
        }
        if ($request->bestrated) {
            $search->orderBy('rate', 'desc');
        }
        if ($request->trending) {
            $search->orderBy('views', 'desc');
        }
        if ($request->NoSell) {
            $search->where('sell', 0)->get();
        }
        if ($request->LowSell) {
            $search->where('sell', '>=', 1)->where('sell', '<=', 300);
        }
        if ($request->MediumSell) {
            $search->where('sell', '>', 300)->where('sell', '<=', 600);
        }
        if ($request->HighSell) {
            $search->where('sell', '>', 600)->where('sell', '<=', 1000);
        }
        if ($request->TopSell) {
            $search->where('sell', '>', 1000);
        }
        /* if ($request->_tag) {
            $search=$search->where('items.tags',  $request->_tag);
           } */
        if ($request->_attribute) {
            switch ($request->_attribute) {
                case 'software_version':
                    if ($request->_tag) {
                        $data = DB::table('sub_attributes')->where('name', $request->_tag)->first();
                        $search = $search->where('items.software_version', $data->id);
                    }
                    break;
                case 'tag':
                    if ($request->_tag) {
                        $search = $search->where('items.tags',  'like', '%' . $request->_tag . '%');
                    }
                    break;
                case 'compatible_with':
                    if ($request->_tag) {
                        $data = DB::table('sub_attributes')->where('name', $request->_tag)->first();
                        $search = $search->where('items.compatible_with', $data->id);
                    }
                    break;
                case 'date':
                    if ($request->_tag) {
                        if ($request->_tag == 'anydate') {
                            $search = $search;
                        } elseif ($request->_tag == 'last_year') {
                            $search->whereDate('items.created_at', '<=', date('Y-m-d', strtotime('-1 years')));
                        } elseif ($request->_tag == 'last_month') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')]);
                        } elseif ($request->_tag == 'last_week') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')]);
                        } elseif ($request->_tag == 'last_day') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')]);
                        }
                    }
                    break;

                default:
                    break;
            }
        }
        if ($request->star) {
            switch ($request->star) {
                case 1:
                    $search->where('rate', '>=', 1)->where('rate', '<', 2);
                    break;
                case 2:
                    $search->where('rate', '>=', 2)->where('rate', '<', 3);
                    break;
                case 3:
                    $search->where('rate', '>=', 3)->where('rate', '<', 4);
                    break;
                case 4:
                    $search->where('rate', '>=', 4)->where('rate', '<', 5);
                    break;
                case 5:
                    $search->where('rate', '>=', 5);
                    break;
                default:
                    $search;
                    break;
            }
        }

        $data = $search->paginate(8);
        return response()->json($data, 200);
    }

    public function tagWiseItem(Request $request)
    {

        $all = '';
        $bestsell = '';
        $newest = '';
        $bestrated = '';
        $trending = '';
        $high = '';
        $low = '';

        if (isset($_GET['all'])) {
            $all = $_GET['all'];
        }
        if (isset($_GET['bestsell'])) {
            $bestsell = $_GET['bestsell'];
        }
        if (isset($_GET['newest'])) {
            $newest = $_GET['newest'];
        }

        if (isset($_GET['bestrated'])) {
            $bestrated = $_GET['bestrated'];
        }
        if (isset($_GET['trending'])) {
            $trending = $_GET['trending'];
        }
        if (isset($_GET['high'])) {
            $high = $_GET['high'];
        }
        if (isset($_GET['low'])) {
            $low = $_GET['low'];
        }
        $search = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
            ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
            ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_categories.title as category', 'item_fees.support_fee')
            //    ->where('items.category_id',$request->_categor_id)
            ->where('items.status', 1)->where('items.active_status', 1);
        /*  ->where('bestsell','like','%'.$bestsell.'%') */
        /*  ->where('trending','like','%'.$trending.'%')  */
        if ($request->_categor_id) {
            $search = $search->where('items.category_id', $request->_categor_id);
        }
        if ($request->min_price && $request->max_price) {
            $search = $search->whereBetween('items.Reg_total', [$request->min_price, $request->max_price]);
        }
        if ($request->key) {
            $search = $search->where('items.title', 'like', '%' . $request->key . '%');
        }
        if ($request->_subcategor_id) {
            $search = $search->where('item_sub_categories.slug',  $request->_subcategor_id);
        }

        if ($request->newest) {
            $search = $search->orderBy('id', 'DESC');
        }

        if ($low == "low") {
            $search = $search->orderBy('Reg_total', 'asc');
        }
        if ($high == "high") {
            $search = $search->orderBy('Reg_total', 'DESC');
        }
        if ($request->bestsell) {
            $search->orderBy('sell', 'desc');
        }
        if ($request->bestrated) {
            $search->orderBy('rate', 'desc');
        }
        if ($request->trending) {
            $search->orderBy('views', 'desc');
        }
        if ($request->_attribute) {
            switch ($request->_attribute) {
                case 'software_version':
                    if ($request->_tag) {
                        $data = DB::table('sub_attributes')->where('name', $request->_tag)->first();
                        $search = $search->where('items.software_version', $data->id);
                    }
                    break;
                case 'tag':
                    if ($request->_tag) {
                        $search = $search->where('items.tags',  'like', '%' . $request->_tag . '%');
                    }
                    break;
                case 'tags':
                    if ($request->_tag) {
                        $search = $search->where('items.tags',  'like', '%' . $request->_tag . '%');
                    }
                    break;
                case 'compatible_with':
                    if ($request->_tag) {
                        $data = DB::table('sub_attributes')->where('name', $request->_tag)->first();
                        $search = $search->where('items.compatible_with', $data->id);
                    }
                    break;
                case 'date':
                    if ($request->_tag) {
                        if ($request->_tag == 'anydate') {
                            $search = $search;
                        } elseif ($request->_tag == 'last_year') {
                            //return response()->json('lol', 200);

                            $search->whereDate('items.created_at', '<=', date('Y-m-d', strtotime('-1 years')));
                        } elseif ($request->_tag == 'last_month') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')]);
                        } elseif ($request->_tag == 'last_week') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')]);
                        } elseif ($request->_tag == 'last_day') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')]);
                        }
                    }
                    break;

                default:
                    break;
            }
        }
        if ($request->NoSell) {
            $search->where('sell', 0)->get();
        }
        if ($request->LowSell) {
            $search->where('sell', '>=', 1)->where('sell', '<=', 300);
        }
        if ($request->MediumSell) {
            $search->where('sell', '>', 300)->where('sell', '<=', 600);
        }
        if ($request->HighSell) {
            $search->where('sell', '>', 600)->where('sell', '<=', 1000);
        }
        if ($request->TopSell) {
            $search->where('sell', '>', 1000);
        }
        if ($request->star) {
            switch ($request->star) {
                case 1:
                    $search->where('rate', '>=', 1)->where('rate', '<', 2);
                    break;
                case 2:
                    $search->where('rate', '>=', 2)->where('rate', '<', 3);
                    break;
                case 3:
                    $search->where('rate', '>=', 3)->where('rate', '<', 4);
                    break;
                case 4:
                    $search->where('rate', '>=', 4)->where('rate', '<', 5);
                    break;
                case 5:
                    $search->where('rate', '>=', 5);
                    break;
                default:
                    $search;
                    break;
            }
        }

        $data = $search->paginate(8);
        return response()->json($data, 200);
        // return response()->json($request, 200);
    }

    function formSearch(Request $request)
    {
        try {
            $incoming = $request->key;
            $data['key'] = $request->key;
            $search = DB::table('users')
                ->leftjoin('items', 'users.id', '=', 'items.user_id')
                ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
                ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
                ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
                ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_categories.title as category', 'item_fees.support_fee')
                ->where('items.status', 1)->where('items.active_status', 1)
                ->where('items.title', 'like', '%' . $data['key'] . '%')
                ->orWhere('items.tags', 'like', '%' . $data['key'] . '%')
                ->orWhere('items.description', 'like', '%' . $data['key'] . '%')
                ->orWhere('item_categories.title', 'like', '%' . $data['key'] . '%')
                ->orWhere('item_sub_categories.title', 'like', '%' . $data['key'] . '%');

            $data['item'] = $search->get();

            if ($data['item']->count() < 1) {
                Toastr::warning('Search item not found.', 'Warning');
                return redirect()->back();
            }

            $data['category'] = ItemCategory::where('id', $data['item'][0]->category_id)->where('active_status', 1)->first();
            $data['sub_category'] = ItemSubCategory::where('active_status', 1)->where('item_category_id', $data['item'][0]->category_id)->get();

            $data = $this->sellWise($data);
            $data = $this->starWise($data);
            $data = $this->dateWise($data);
            $data = $this->searchPage($data);

            return view('frontend.pages.search', compact('data'));
        } catch (Exception $e) {
            Toastr::warning('Search item not found.', 'Warning');
            return redirect()->back();
        }
    }
    function searchItem($nuxt = null)
    {
        try {
            $incoming = explode("=", $nuxt);
            $data['key'] = $incoming[1];
            $data['category'] = ItemCategory::where('slug', $incoming[0])->where('active_status', 1)->first();
            $data['sub_category'] = ItemSubCategory::where('active_status', 1)->where('item_category_id', $data['category']->id)->get();

            $search = DB::table('users')
                ->leftjoin('items', 'users.id', '=', 'items.user_id')
                ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
                ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
                ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
                ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_categories.title as category', 'item_fees.support_fee')
                ->where('items.status', 1)->where('items.active_status', 1)
                ->where('items.title', 'like', '%' . $data['key'] . '%')
                ->orWhere('items.description', 'like', '%' . $data['key'] . '%')
                ->orWhere('items.tags', 'like', '%' . $data['key'] . '%')
                ->orWhere('item_categories.title', 'like', '%' . $data['key'] . '%')
                ->orWhere('item_sub_categories.title', 'like', '%' . $data['key'] . '%');

            $data['item'] = $search->get();
            // return $data;
            $data = $this->sellWise($data);
            $data = $this->starWise($data);
            $data = $this->dateWise($data);
            $data = $this->searchPage($data);

            return view('frontend.pages.search', compact('data'));
        } catch (Exception $e) {
            Toastr::warning('Search item not found.', 'Warning');
            return redirect()->back();
        }
    }

    function by_SearchItem(Request $request)
    {
        // return $request;
        try {
            $data['key'] = $request->key;
            Session::put('key', $request->key);
            // $data['category'] = ItemCategory::where('active_status', 1)->get();
            $data['category'] = ItemCategory::where('active_status', 1)->first();
            $data['_category_'] = ItemCategory::where('active_status', 1)->get();
            // return $data['category'];
            $search = DB::table('users')
                ->leftjoin('items', 'users.id', '=', 'items.user_id')
                ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
                ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
                ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
                ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_sub_categories.slug as sub_slug', 'item_categories.title as category', 'item_categories.slug as cat_slug', 'item_fees.support_fee')
                ->where('items.status', 1)->where('items.active_status', 1)
                ->where('items.title', 'like', '%' . $request->key . '%')
                ->orWhere('items.description', 'like', '%' . $request->key . '%')
                ->orWhere('item_categories.title', 'like', '%' . $request->key . '%')
                ->orWhere('item_sub_categories.title', 'like', '%' . $request->key . '%');
            $data['item'] = $search->get();
            $data = $this->sellWise($data);
            $data = $this->starWise($data);
            $data = $this->dateWise($data);
            if ($data['item']->count() < 1) {
                Toastr::warning('Search item not found.', 'Warning');
                return redirect()->back();
            }
            // return $data;
            return view('frontend.pages.search', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            // Toastr::warning('Search item not found.', 'Warning');
            return redirect()->back();
        }
    }
    function Getby_SearchItem($request)
    {
        $data['key'] = $request;
        Session::put('key', $request);
        $data['_category_'] = ItemCategory::where('active_status', 1)->get();
        $search = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
            ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
            ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_sub_categories.slug as sub_slug', 'item_categories.title as category', 'item_categories.slug as cat_slug', 'item_fees.support_fee')
            ->where('items.status', 1)->where('items.active_status', 1)
            ->where('items.title', 'like', '%' . $request . '%')
            ->orWhere('items.id', 'like', '%' . $request . '%')
            ->orWhere('items.description', 'like', '%' . $request . '%')
            ->orWhere('item_categories.title', 'like', '%' . $request . '%')
            ->orWhere('item_sub_categories.title', 'like', '%' . $request . '%');


        $data['item'] = $search->get();
        return $data;
    }
    function uniquTagPCount($data)
    {
        $uniqueTags = [];
        $uniquesoftware = [];
        foreach ($data['item'] as $key => $item) {
            foreach (array_unique(explode(",", $item->tags)) as $key => $value) {
                $uniqueTags[$value] = $value;
            }
        }

        foreach ($uniqueTags as $val) {
            if (@$data['sub_cat']) {
                @$number = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('tags', 'LIKE', '%' . @$val . '%')->get()->count();
            } else {
                @$number = DB::table('items')->where('category_id', @$data['category']->id)->where('tags', 'LIKE', '%' . @$val . '%')->get()->count();
            }
        }
        return $number;
    }

    function searchPage($data)
    {
        $uniqueTags = [];
        $uniqueCat = [];
        foreach ($data['item'] as $key => $item) {
            foreach (array_unique(explode(",", $item->tags)) as $key => $value) {
                $uniqueTags[@$value] = @$value;
                $uniqueCat[@$item->category] = @$item->category;
            }
        }

        foreach ($uniqueTags as $val) {
            if (@$data['category']) {
                $number = DB::table('items')->where('category_id', @$data['category']->id)->where('tags', 'LIKE', '%' . @$val . '%')->get()->count();

                $_cat_slug = null;
            } else {
                $number = DB::table('items')->where('title', 'LIKE', '%' . @$data['key'] . '%')->where('tags', 'LIKE', '%' . @$val . '%')->get()->count();
                $Cat_slug = DB::table('items')->where('title', 'LIKE', '%' . @$data['key'] . '%')->where('tags', 'LIKE', '%' . @$val . '%')->first();
                $_cat_slug = DB::table('item_categories')->find(@$Cat_slug->category_id);
            }
        }

        $data['number'] = $number;
        $data['_cat_slug'] = $_cat_slug;
        return $data;
    }
    function feature_item()
    {
        try {
            $data['_category_'] = ItemCategory::where('active_status', 1)->get();
            $data['_feature_item'] = 'feature_item';
            $search = DB::table('users')
                ->leftjoin('items', 'users.id', '=', 'items.user_id')
                ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
                ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
                ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
                ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_sub_categories.slug as sub_slug', 'item_categories.title as category', 'item_categories.slug as cat_slug', 'item_fees.support_fee')
                ->where('items.status', 1)->where('items.active_status', 1);
            $data['item'] = $search->get();
            // dd($data['item'][0]);
            $data = $this->sellWise($data);
            $data = $this->starWise($data);
            $data = $this->dateWise($data);

            return view('frontend.pages.search', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function packagePlan()
    {
        try {
            $data['package'] = Package::latest()->get();
            return view('frontend.pages.package_plan', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function License()
    {

        try {
            $data = LicensePage::where('active_status', 1)->first();
            $license_features = LicenseFeature::where('active_status', 1)->get();
            return view('frontend.pages.license', compact('data', 'license_features'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function faqPage()
    {
        try {
            $faqs_even = DB::table('infix_faqs')->whereRaw('MOD(id, 2) = 0')->get();
            $faqs_odd = DB::table('infix_faqs')->whereRaw('MOD(id, 2) = 1')->get();
            return view('frontend.pages.faq_page', compact('faqs_even', 'faqs_odd'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function privacyPolicy()
    {
        try {
            $privacyPolicies = InfixPrivacyPolicy::get();
            return view('frontend.pages.privacy_policy', compact('privacyPolicies'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function aboutCompany()
    {
        try {
            $about_company = InfixAboutCompany::find(1);
            return view('frontend.pages.about', compact('about_company'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function termsConditions()
    {
        try {
            $term_conditions = InfixTermCondition::get();
            return view('frontend.pages.term_conditions', compact('term_conditions'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function knowledgeBase()
    {
        // return "knowledgeBase";
        try {
            // $know_base_categories = InfixKnowledgeBaseCategory::where('active_status', 1)->get();
            $know_base_categories = InfixKnowledgeBaseCategory::where('active_status', 1)->with('firstQuestion')->get();
            return view('frontend.pages.knowledge_base', compact('know_base_categories'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function packageOption($name)
    {
        try {
            $data['country'] = SpnCountry::all();
            $data['user'] = User::find(Auth::user()->id);
            $packageType['type'] = PackageType::where('slug', $name)->first();
            $data['package'] = Package::where('package_type', $packageType['type']->id)->first();
            $data['all_package'] = Package::latest()->get();
            $data['payment'] = PaymentPackage::where('user_id', Auth::user()->id)->get();
            return view('frontend.pages.package_buy', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function packagePrice($package)
    {
        $packageType = PackageType::find($package);
        return response()->json($packageType, 200);
    }
    function payment()
    {
        try {
            if (@Session::get('package')) {
                $paid_payment = PaidPayment::where('user_id', Auth::user()->id)->first();
                $data = Session::get('package');
                $package = Package::find($data['package_plan']);
                $packagetype = PackageType::where(['id' => $package->package_type])->first();
                return view('frontend.payment.package_payment', compact('data', 'package', 'packagetype', 'paid_payment'));
            } else {
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function payment_main_balance(Request $r, $price)
    {
        $balnc  = Auth::user()->balance;
        //return response()->json($price,200); 
        if ($price > 10) {
            if ($balnc->amount < $price) {
                return response()->json('Your balance is insufficient', 400);
            } else {

                if (@Session::get('package')) {
                    $data = Session::get('package');
                    if ($price >= @$data['package_price']) {
                        $balnc->amount = $balnc->amount - floatval($price);
                        $balnc->save();
                        $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]);
                        $paid_payment->amount = $price;
                        $paid_payment->save();
                        return response()->json('Payment success', 200);
                    } else {
                        return response()->json('Please  make payment', 400);
                    }
                } else {
                    return response()->json('Something went wrong ! try again', 400);
                }
            }
        } else {
            return response()->json('please payment minimum $10', 400);
        }
    }
    function packageBuy(Request $r)
    {
        $r->validate([
            'package_plan' => 'required',
            'package_price' => 'required|',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_name' => 'required|string',
            'address' => 'required|string',
            'country_id' => 'required|',
            'state_id' => 'required|',
            'city_id' => 'required|',
            'total' => 'required|',
            'zipcode' => 'required|',
        ]);
        try {
            $packag = Package::find($r->package_plan);
            $d = BuyPackage::where('package_plan', $r->package_plan)->first();
            if (@$d) {
                Toastr::warning('Already buy this package');
                return redirect()->back();
            }
            Session::put('package', $r->input());
            return redirect()->route('user.payment');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function packagePaid(Request $r)
    {
        $rules = [
            'due_payment' => 'required|',
        ];
        $customMessages = [
            'required' => 'Please complete payment first'
        ];
        DB::beginTransaction();
        // $this->validate($r, $rules, $customMessages);
        try {
            if (@Session::get('package')) {
                $paid_payment = PaidPayment::where('user_id', Auth::user()->id)->first();
                if ($paid_payment) {
                    $data = Session::get('package');
                    if ($paid_payment->amount >= @$data['package_price']) {
                        $packag = Package::find($data['package_id']);
                        $package_buy = new BuyPackage();
                        $package_buy->user_id  = Auth::user()->id;
                        $package_buy->package_plan  = $data['package_plan'];
                        $package_buy->package_price = $data['package_price'];
                        $package_buy->totalItem         = $packag->total_item;
                        $package_buy->total         = $data['total'];
                        $package_buy->save();

                        $user = User::find(Auth::user()->id);

                        $pro = $user->profile;
                        $pro->first_name = $data['first_name'];
                        $pro->last_name = $data['last_name'];
                        $pro->company_name = $data['company_name'];
                        $pro->address = $data['address'];
                        $pro->country_id = $data['country_id'];
                        $pro->state_id = $data['state_id'];
                        $pro->city_id = $data['city_id'];
                        $pro->zipcode = $data['zipcode'];
                        $pro->save();
                        $paid_payment->delete();
                        DB::commit();
                        Toastr::success('Thank yopu for purchasing !');
                        return redirect()->back();
                    } else {
                        Toastr::error('Please make payment');
                        return redirect()->back();
                    }
                } else {
                    Toastr::error('Please complete payment first');
                    return redirect()->back();
                }
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function packagePayment(Request $request)
    {
        $input = $request->input();
        $balnc  = Auth::user()->balance;
        DB::beginTransaction();
        try {
            if ($input['amount'] > 50) {
                if ($balnc->amount < $input['amount']) {
                    /* Toastr::success('Your balance is insufficient');
                    return redirect()->back();
                }else { */
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $stripe_id = uniqid();
                    // Charge to customer
                    $charge = Charge::create(array(
                        'description' => " - Amount: " . $input['amount'] . ' - ' . $stripe_id,
                        'source' => $request->stripeToken,
                        'amount' => (int) ($input['amount'] * 100),
                        'currency' => 'USD'
                    ));
                    PaymentPackage::create([
                        'user_id' => Auth::user()->id,
                        'amount' => $input['amount'],
                        'charge_id' => $charge->id,
                        'stripe_id' => $stripe_id,
                        'package_plan' => $input['package_plan_id'],
                    ]);
                    $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]);
                    $paid_payment->amount = $input['amount'];
                    $paid_payment->save();
                    DB::commit();
                    Toastr::success('Thank you for payment!');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Please payment minimum $50');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function refundRequest()
    {
        try {
            // return Auth::user()->id;
            $data['item_order'] = ItemOrder::where('user_id', Auth::user()->id)->get();
            $data['refund'] = RefundReason::where('status', 1)->latest()->get();
            $refunds = Refund::where('status', 1)->where('user_id', Auth::user()->id)->get();

            $refunds_list = [];
            foreach ($refunds as $key => $refund) {
                $refunds_list[] = $refund->order_item_id;
            }
            $data['refunds_list'] = $refunds_list;

            //  return  $data['item_order'];
            return view('frontend.pages.refund_request', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function refundStore(Request $res)
    {
        $res->validate([
            'item_id' => 'required|integer',
            'ref_id' => 'required|integer',
            'refund_details' => 'required|string',
        ]);
        DB::beginTransaction();
        // return $res;
        try {
            $re = Refund::where('order_item_id', $res->item_id)->where('user_id', Auth::user()->id)->count();

            // return $re;
            if (@$re > 0) {
                Toastr::error('Already you send refund request');
                return redirect()->back();
            } else
                $item_order = ItemOrder::find($res->item_id);
            $item = Item::find($item_order->item_id);
            $data = new Refund();
            $data->user_id = Auth::user()->id;
            $data->author_id = $item->user_id;
            $data->order_item_id = $res->item_id;
            $data->item_id = $item->id;
            $data->ref_id = $res->ref_id;
            $data->refund_details = $res->refund_details;
            $data->save();
            DB::commit();
            Toastr::success('Request sent for refund');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function ApiTokenUpdate(Request $request)
    {
        try {
            $token = Str::random(60);
            $user = User::where('id', '=', Auth::user()->id)->first();
            $user->api_token = $token;
            $user->save();
            Toastr::success('API Token Generated Successfully');
            return redirect()->route('author.setting', Auth::user()->id . '?api_key');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function market_apis()
    {
        try {
            $market_api = MarketApi::first();
            return view('frontend.pages.market_apis', compact('market_api'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function featureitemImage($id)
    {
        $data = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->select('items.title', 'items.Reg_total as total', 'items.thumbnail', 'users.username as username')
            ->where('items.status', 1)->where('items.active_status', 1)
            ->where('items.id', 'like', '%' . $id . '%')->first();
        return response()->json($data, 200);
    }
    function BecomeAuthor()
    {
        try {
            $author_text = BecomeAuthor::first();
            return view('frontend.pages.Become_author', compact('author_text'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function BecomeAuthorconfirm()
    {
        if (GeneralSetting()->public_vendor == 0) {
            Toastr::error('Public Vendor Registration Disabled', 'Failed');
            return redirect('/');
        }
        try {
            $data = Auth::user();
            $data->role_id = 4;
            $data->save();
            Toastr::success('Operation success!');
            return redirect('/');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    // start   free item 
    function free_item()
    {
        $data = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('free_items', 'items.id', '=', 'free_items.item_id')
            ->select('items.title', 'items.id as id', 'items.icon', 'users.username as username')
            ->where('items.status', 1)
            ->where('items.active_status', 1)
            ->where('items.free', 1)
            ->where('free_items.date', date('m'))->paginate(8);
        return response()->json($data, 200);
    }
    function free_items()
    {
        try {
            $data['_category_'] = ItemCategory::where('active_status', 1)->get();
            $search = DB::table('users')
                ->leftjoin('items', 'users.id', '=', 'items.user_id')
                ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
                ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
                ->leftjoin('free_items', 'items.id', '=', 'free_items.item_id')
                ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
                ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_sub_categories.slug as sub_slug', 'item_categories.title as category', 'item_categories.slug as cat_slug', 'item_fees.support_fee')
                ->where('items.free', 1)
                ->where('items.status', 1)
                ->where('items.active_status', 1)
                ->where('free_items.date', date('m'));
            $data['item'] = $search->paginate(18);

            if (@$data['sub_cat']) {
                $data['no'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', 0)->get()->count();
                $data['low'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1)->where('sell', '<=', 300)->get()->count();
                $data['medium'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 300)->where('sell', '<=', 600)->get()->count();
                $data['high'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 600)->where('sell', '<=', 1000)->get()->count();
                $data['top'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1000)->get()->count();
            } else {
                $data['no'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('sell', 0)->get()->count();
                $data['low'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('sell', '>=', 1)->where('sell', '<=', 300)->get()->count();
                $data['medium'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('sell', '>', 300)->where('sell', '<=', 600)->get()->count();
                $data['high'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('sell', '>', 600)->where('sell', '<=', 1000)->get()->count();
                $data['top'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('sell', '>', 1000)->get()->count();
            }


            if (@$data['sub_cat']) {
                $data['oneStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 1)->where('rate', '<', 2)->get()->count();
                $data['TwoStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 2)->where('rate', '<', 3)->get()->count();
                $data['ThreStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 3)->where('rate', '<', 4)->get()->count();
                $data['FourStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 4)->where('rate', '<', 5)->get()->count();
                $data['FivStar'] = DB::table('items')->where('sub_category_id', @$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->where('rate', '>=', 5)->get()->count();
            } else {
                $data['oneStar'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('rate', '>=', 1)->where('rate', '<', 2)->get()->count();
                $data['TwoStar'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('rate', '>=', 2)->where('rate', '<', 3)->get()->count();
                $data['ThreStar'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('rate', '>=', 3)->where('rate', '<', 4)->get()->count();
                $data['FourStar'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('rate', '>=', 4)->where('rate', '<', 5)->get()->count();
                $data['FivStar'] = DB::table('items')->where('active_status', 1)->where('status', 1)->where('rate', '>=', 5)->get()->count();
            }
            if (@$data['category']) {
                $data['Any_Date'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->count();
                $data['LastYear'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d', strtotime('-1 years')))->count();
                $data['Last_month'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')])->count();
                $data['Last_week'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')])->count();
                $data['Last_day'] = DB::table('items')->where('category_id', @$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')])->count();
            } else {
                $data['Any_Date'] = DB::table('items')->where('title', 'LIKE', '%' . @$data['key'] . '%')->where('active_status', 1)->where('status', 1)->count();
                $data['LastYear'] = DB::table('items')->where('title', 'LIKE', '%' . @$data['key'] . '%')->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d', strtotime('-1 years')))->count();
                $data['Last_month'] = DB::table('items')->where('title', 'LIKE', '%' . @$data['key'] . '%')->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')])->count();
                $data['Last_week'] = DB::table('items')->where('title', 'LIKE', '%' . @$data['key'] . '%')->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')])->count();
                $data['Last_day'] = DB::table('items')->where('title', 'LIKE', '%' . @$data['key'] . '%')->where('active_status', 1)->where('status', 1)->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')])->count();
            }



            $uniqueCat = [];
            $countCategory = 0;
            foreach ($data['item'] as $key => $item) {
                $uniqueCat[$key]['id'] = $item->category_id;
                $uniqueCat[$key]['name'] = $item->category;
            }

            $cat_count = [];
            foreach ($uniqueCat as  $cat) {
                $cat_count[$cat['id']] = DB::table('items')->where('category_id', $cat['id'])->count();
            }



            return view('frontend.pages.free_item', compact('data', 'cat_count'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function FreeWiseItem(Request $request)
    {
        $all = '';
        $bestsell = '';
        $newest = '';
        $bestrated = '';
        $trending = '';
        $high = '';
        $low = '';

        if (isset($_GET['all'])) {
            $all = $_GET['all'];
        }
        if (isset($_GET['bestsell'])) {
            $bestsell = $_GET['bestsell'];
        }
        if (isset($_GET['newest'])) {
            $newest = $_GET['newest'];
        }

        if (isset($_GET['bestrated'])) {
            $bestrated = $_GET['bestrated'];
        }
        if (isset($_GET['trending'])) {
            $trending = $_GET['trending'];
        }
        if (isset($_GET['high'])) {
            $high = $_GET['high'];
        }
        if (isset($_GET['low'])) {
            $low = $_GET['low'];
        }
        $search = DB::table('users')
            ->leftjoin('items', 'users.id', '=', 'items.user_id')
            ->leftjoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->leftjoin('item_sub_categories', 'items.sub_category_id', '=', 'item_sub_categories.id')
            ->leftjoin('free_items', 'items.id', '=', 'free_items.item_id')
            ->leftjoin('item_fees', 'item_fees.category_id', '=', 'items.category_id')
            ->select('items.*', 'users.username as username', 'item_sub_categories.title as sub_category', 'item_categories.title as category', 'item_fees.support_fee')
            ->where('items.status', 1)
            ->where('items.active_status', 1)
            ->where('items.free', 1)
            ->where('free_items.date', date('m'));
        /*  ->where('bestsell','like','%'.$bestsell.'%') */
        /*  ->where('trending','like','%'.$trending.'%')  */
        if ($request->_categor_id) {
            $search = $search->where('items.category_id', $request->_categor_id);
        }
        if ($request->key) {
            $search = $search->Where('items.title', 'like', '%' . $request->key . '%')->orWhere('items.id', 'like', '%' . $request->key . '%');
        }
        if ($request->min_price && $request->max_price) {
            $search = $search->whereBetween('items.Reg_total', [$request->min_price, $request->max_price]);
        }

        if ($request->_subcategor_id) {
            $search = $search->where('item_sub_categories.slug',  $request->_subcategor_id);
        }

        if ($request->newest) {
            $search->orderBy('id', 'DESC');
        }

        if ($low == "low") {
            $search->orderBy('Reg_total', 'asc');
        }
        if ($high == "high") {
            $search->orderBy('Reg_total', 'DESC');
        }
        if ($request->bestsell) {
            $search->orderBy('sell', 'desc');
        }
        if ($request->bestrated) {
            $search->orderBy('rate', 'desc');
        }
        if ($request->trending) {
            $search->orderBy('views', 'desc');
        }
        if ($request->NoSell) {
            $search->where('sell', 0)->get();
        }
        if ($request->LowSell) {
            $search->where('sell', '>=', 1)->where('sell', '<=', 300);
        }
        if ($request->MediumSell) {
            $search->where('sell', '>', 300)->where('sell', '<=', 600);
        }
        if ($request->HighSell) {
            $search->where('sell', '>', 600)->where('sell', '<=', 1000);
        }
        if ($request->TopSell) {
            $search->where('sell', '>', 1000);
        }
        /* if ($request->_tag) {
            $search=$search->where('items.tags',  $request->_tag);
           } */
        if ($request->_attribute) {
            switch ($request->_attribute) {
                case 'software_version':
                    if ($request->_tag) {
                        $data = DB::table('sub_attributes')->where('name', $request->_tag)->first();
                        $search = $search->where('items.software_version', $data->id);
                    }
                    break;
                case 'tags':
                    if ($request->_tag) {
                        $search = $search->where('items.tags',  'like', '%' . $request->_tag . '%');
                    }
                    break;
                case 'compatible_with':
                    if ($request->_tag) {
                        $data = DB::table('sub_attributes')->where('name', $request->_tag)->first();
                        $search = $search->where('items.compatible_with', $data->id);
                    }
                    break;
                case 'date':
                    if ($request->_tag) {
                        if ($request->_tag == 'anydate') {
                            $search = $search;
                        } elseif ($request->_tag == 'last_year') {
                            $search->whereDate('items.created_at', '<=', date('Y-m-d', strtotime('-1 years')));
                        } elseif ($request->_tag == 'last_month') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 months')), date('Y-m-d')]);
                        } elseif ($request->_tag == 'last_week') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d')]);
                        } elseif ($request->_tag == 'last_day') {
                            $search = $search->whereBetween('items.created_at', [date('Y-m-d', strtotime('-1 days')), date('Y-m-d')]);
                        }
                    }
                    break;

                default:
                    break;
            }
        }
        if ($request->star) {
            switch ($request->star) {
                case 1:
                    $search->where('rate', '>=', 1)->where('rate', '<', 2);
                    break;
                case 2:
                    $search->where('rate', '>=', 2)->where('rate', '<', 3);
                    break;
                case 3:
                    $search->where('rate', '>=', 3)->where('rate', '<', 4);
                    break;
                case 4:
                    $search->where('rate', '>=', 4)->where('rate', '<', 5);
                    break;
                case 5:
                    $search->where('rate', '>=', 5);
                    break;
                default:
                    $search;
                    break;
            }
        }

        $data = $search->paginate(8);
        return response()->json($data, 200);
    }
    // end   free item 

    // public function ajaxLanguageChangeMenu(Request $request)
    // {
    //     try {
    //         $uni = $request->id;
    //         if (Auth::check()) {
    //             $user=User::find(Auth::user()->id);
    //             $user->lang_id=$request->id;
    //             $user->save();
    //         }



    //         $updateLang = InfixLanguage::where('language_universal', $uni)->first();
    //         if (Auth::check() && $updateLang->language_universal=='ar') {
    //            $user->rtl=1;
    //            $user->save();
    //         }

    //         session()->put('locale',$updateLang->language_universal);

    //         return response()->json([$updateLang]);
    //     } catch (Exception $e) {
    //         Toastr::error('Operation Failed', 'Failed');
    //         return redirect()->back();
    //     }
    // }

}
