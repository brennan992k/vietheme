<?php

namespace App\Http\Controllers\Frontend\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;

class FrontendVendorController extends Controller
{
    function statementsearch(Request $res)
    {
        //  return response()->json($res->all(), 200);
        try {
           
            //return response()->json($res->all(), 200);
            if (!empty($res->from) && !empty($res->to)) {
                $data['statement'] = DB::table('statements')->where('author_id', Auth::user()->id)->whereBetween('created_at', [$res->from, $res->to])->get();
                if (empty($statement)) {
                    $statement = 0;
                }
                $data['AuthorTax'] = Auth::user()->profile->country->tax;
                return response()->json($data, 200);
            } else {
                return response()->json(['error' => 'data not found'], 201);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e], 201);
        }
    }
}
