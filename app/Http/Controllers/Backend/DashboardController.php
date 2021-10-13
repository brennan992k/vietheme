<?php

namespace App\Http\Controllers\Backend;

use App\Models\ItemOrder;
use App\Models\ItemPreview;
use Nwidart\Modules\Module;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Analytics;

class DashboardController extends Controller
{
    /* public function __construct()
    {
        $this->middleware(['auth','admin']);
    } */

    static function country()
    {
        $country = Analytics::performQuery(Period::days(14), 'ga:sessions',  ['dimensions' => 'ga:country', 'sort' => '-ga:sessions']);
        $result = collect($country['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'country' =>  $dateRow[0],
                'sessions' => (int) $dateRow[1],
            ];
        });
        return $result;
    }

    static function topbrowsers()
    {
        $analyticsData = Analytics::fetchTopBrowsers(Period::days(14));
        $array = $analyticsData->toArray();
        foreach ($array as $k => $v) {
            $array[$k]['label'] = $array[$k]['browser'];
            unset($array[$k]['browser']);
            $array[$k]['value'] = $array[$k]['sessions'];
            unset($array[$k]['sessions']);
            $array[$k]['color'] = $array[$k]['highlight'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }
        return json_encode($array);
    }

    function index()
    {


        try {
            $years = date("Y") - 5;
            $result = array();
            $Yearstr = "";
            $result['nameWithVal'] = "";

            $yearlyValue = "";
            $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            $commaCount = 0;
            $mystring = "";
            foreach ($months as $month) {
                $MonthlyTotal = DB::table('item_orders')->where('created_at', 'LIKE', '%' . date('Y') . '-' . $month . '%')->sum('subtotal');
                if ($commaCount == 0) {
                    $yearlyValue = $MonthlyTotal;
                } else {
                    $yearlyValue = $yearlyValue . ', ' . $MonthlyTotal;
                }
                $commaCount++;
            }
            $top_ten_seller =  DB::table('users')
                ->join('items', 'users.id', '=', 'items.user_id')
                ->select('users.username', 'users.email', DB::raw('max(items.sell) as sell'))
                ->where('users.role_id', 4)
                ->groupBy('users.id', 'users.username', 'users.email')
                ->orderBy('sell', 'desc')
                ->take(5)
                ->get();

            $new_ten_seller =  DB::table('users')
                ->leftjoin('items', 'users.id', '=', 'items.user_id')
                ->select('users.username', 'users.email', DB::raw('max(items.sell) as sell'))
                ->where('users.role_id', 4)
                ->groupBy('users.id', 'users.username', 'users.email')
                ->orderBy('users.created_at', 'desc')
                ->take(5)
                ->get();

            //Retrieve Most Visited Pages



            $Activeuser = DB::table('users')->where('role_id', '!=', 1)->where('status', 1)->where('access_status', 1)->count();
            $ActiveCustomer = DB::table('users')->where('role_id', '=', 5)->where('status', 1)->where('access_status', 1)->count();
            $ActiveVendor = DB::table('users')->where('role_id', '=', 4)->where('status', 1)->where('access_status', 1)->count();
            $blocked_users = DB::table('users')->where('role_id', '!=', 1)->where('access_status', 0)->count();
            $ActiveItem = DB::table('items')->where('status', 1)->where('active_status', 1)->count();
            $TotalItem = DB::table('items')->where('active_status', 1)->count();
            $InactiveItem = DB::table('items')->where('status', 0)->where('active_status', 1)->count();
            $update_pending = ItemPreview::where(['status' => 1])->count();;
            $ItemSale = DB::table('item_orders')->count();
            $ItemEarning = DB::table('balance_sheets')->sum('income');



            $analyticsData_one = Analytics::fetchTotalVisitorsAndPageViews(Period::days(14));
            $visitor = Analytics::fetchUserTypes(Period::days(14));
            $data['dates'] = $analyticsData_one->pluck('date');

            $data['visitors'] = $analyticsData_one->pluck('visitors');
            $data['pageViews'] = $analyticsData_one->pluck('pageViews');
            $data['browserjson'] = $this->topbrowsers();
            $result = $this->country();
            $data['country'] = $result->pluck('country');
            $data['country_sessions'] = $result->pluck('sessions');
            $data['visitor_type'] = $visitor->pluck('type');
            $data['visitor_session'] = $visitor->pluck('sessions');




            return view('backend.dashboard_ga', compact(
                'data',
                'result',
                'Yearstr',
                'yearlyValue',
                'top_ten_seller',
                'new_ten_seller',
                'Activeuser',
                'ActiveCustomer',
                'ActiveVendor',
                'blocked_users',
                'ActiveItem',
                'TotalItem',
                'InactiveItem',
                'ItemSale',
                'ItemEarning',
                'update_pending'
            ));
        } catch (\Google\Service\Exception $ga) {

            return view('backend.dashboard', compact(
                'result',
                'Yearstr',
                'yearlyValue',
                'top_ten_seller',
                'new_ten_seller',
                'Activeuser',
                'ActiveCustomer',
                'ActiveVendor',
                'blocked_users',
                'ActiveItem',
                'TotalItem',
                'InactiveItem',
                'ItemSale',
                'ItemEarning',
                'update_pending'
            ));
        } catch (Exception $e) {
            dd($e);
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function DashboardChart(Request $res)
    {
        try {
            if (!empty($res->month)) {
                $month = $res->month;
                $year = $res->year;
            } else {

                $month = date("m");
                $year = date("y");
            }

            $number_of_days = date("t", mktime(0, 0, 0, $month, 1, $year));

            $data = [];
            for ($i = 1; $i <= $number_of_days; $i++) {
                if ($i < 10) {
                    $days = '0' . $i;
                } else {
                    $days = $i;
                }
                $search_date = $year . '-' . $month . '-' . $days;
                $total_price = ItemOrder::where('created_at', 'LIKE', '%' . $search_date . '%')->sum('subtotal');
                $total_sell = ItemOrder::where('created_at', 'LIKE', '%' . $search_date . '%')->count();
                if (empty($total_price)) {
                    $total_price = 0;
                }
                if (empty($total_sell)) {
                    $total_sell = 0;
                }
                $data[] = $days . '#' . $total_price . '#' . $total_sell;
            }

            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'data not found'], 201);
        }
    }




    public function addonsSetting()
    {

        try {
            $module = Module::all();
            // $data['module_name']= $module->getName();
            // $data['getLowerName']= $module->getLowerName();
            // $data['getPath']= $module->getPath();
            // $data['getExtraPath']= $module->getExtraPath('Assets');
            // $data['disable']= $module->disable();
            // $data['enable']= $module->enable();
            // $data['getRequires']= $module->getRequires();

            $modules_name = [];

            foreach ($module as $key => $value) {
                $modules_name[] = $key;
                $module = Module::find($key);
                $data[$key]['module_name'] = $module->getName();
                $data[$key]['getPath'] = $module->getPath();
                $data[$key]['getExtraPath'] = $module->getExtraPath('Assets');
                $data[$key]['is_enable'] = $module->enable();
            }
            return view('backend.modules.index', compact('data', 'modules_name'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
