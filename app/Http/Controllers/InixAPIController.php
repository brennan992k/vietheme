<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PurchaseCode;
use App\Models\ApiBaseMethod;
use App\Models\Item;
use Illuminate\Http\Request;

class InixAPIController extends Controller
{
    public function products(Request $request)
    {
        $data = User::all();
        return $data;
    }
    public function product_verify(Request $request, $customer_api_token, $purchase_code)
    {

        if (strlen($customer_api_token) == null) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('User API Token is Required', null);
            }
        } else if (strlen($customer_api_token) != 60) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('User API Token Length is not match with requirement', null);
            }
        } else if (strlen($purchase_code) == null) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('User API Token is Required', null);
            }
        } else if (strlen($purchase_code) != 19) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Product Purchase Code Length is not match with requirement', null);
            }
        } else {
            if ($request->fullUrl()) {
                $authentic_user['VENDOR'] = User::select('full_name', 'email', 'api_token')->where('api_token', $customer_api_token)->first();

                if (empty($authentic_user['VENDOR'])) {
                    return ApiBaseMethod::sendUnAuthorized('Wrong API Token', null);
                }
                $authentic_user['PURCHASE'] = PurchaseCode::select('product_id', 'customer_id', 'purchase_code')->where('purchase_code', $purchase_code)->first();
                if (empty($authentic_user['PURCHASE'])) {
                    return ApiBaseMethod::wrongPurchaseCode('Wrong Purchase Code', null);
                }

                $product_vendor = User::where('api_token', '=', $customer_api_token)
                    ->select('product_id', 'title', 'api_token', 'purchase_code')
                    ->join('items', 'users.id', '=', 'items.user_id')
                    ->join('purchase_codes', 'product_id', '=', 'items.id')
                    ->where('purchase_codes.purchase_code', '=', $purchase_code)
                    ->first();

                if (!empty($product_vendor)) {
                    return ApiBaseMethod::sendResponse($product_vendor, null);
                } else {
                    return ApiBaseMethod::sendError('Product Not Validated', null);
                }
            }
        }
    }





    public function auth_customer(Request $request, $customer_api_token)
    {
        if ($request->fullUrl()) {
            $authentic_user['auth_user'] = User::select('full_name', 'email', 'api_token')->where('api_token', $customer_api_token)->first();
            if ($authentic_user) {
                $authentic_user['message'] = "Successful";
                return response()->json($authentic_user);
            } else {
                $authentic_user['message'] = "Invalid user access token key";
                $authentic_user['demo_token_key'] = "sIPiGFANNeuF4ViUjwwj0339rDYfQHD47hrSUQRFaIVJeDlZBAJ0ZEVB4UzO";
                $authentic_user['url'] = $request->fullUrl();
                $authentic_user['request'] = $request;
                return $authentic_user;
            }
        }
    }

    public function vendors_product(Request $request, $user_api_token)
    {
        $user = User::where('api_token', '=', $user_api_token)->first();

        $p = [];

        $products_list = Item::where('user_id', '=', $user->id)
            ->select('id', 'title', 'description', 'thumbnail')
            ->get();
        foreach ($products_list as $key => $product) {

            $product_url = url('item/' . $product->title . '/' . $product->id);

            $p[$key]['id'] = $product->id;
            $p[$key]['title'] = $product->title;
            $p[$key]['description'] = $product->description;
            $p[$key]['thumbnail'] = $product->thumbnail;
            $p[$key]['product_url'] = $product_url;
        }
        if ($request->fullUrl()) {
            return ApiBaseMethod::sendResponse($p, null);
        } else {
            return ApiBaseMethod::sendError('Product Not Validated', null);
        }
    }
}
