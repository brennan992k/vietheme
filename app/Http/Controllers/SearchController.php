<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    function search(Request $r){

        try{
          if($r->ajax())
          {
           $output = '';
           $query = $r->get('search');
           if($query != '')
           {
              if (Auth::user()->role_id == 1) {
                $data = DB::table('module_permission_links')
                ->where('display_name', 'like', '%'.$query.'%')
                ->where('route', '!=', '')
                ->orderBy('id', 'desc')
                ->get();
                return response()->json($data, 200);
              }
              else {
                $data = DB::table('module_permission_links')
                ->join('assign_module_permissions','assign_module_permissions.module_id','=','module_permission_links.module_id')
                ->where('display_name', 'like', '%'.$query.'%')
                ->where('permission', '=', 1)
                ->where('route', '!=', '')
                ->where('assign_module_permissions.role_id', '=',Auth::user()->role_id)
                ->orderBy('module_permission_links.id', 'desc')
                ->get();
                return response()->json($data, 200);
              }
          }
          else {
              return response()->json(['not found'=>'Not Foound'], 404);

            }

          }
        }catch (Exception $e) {
          return response()->json(['not found'=>$e->getMessage()], 404);
          //  Toastr::error('Operation Failed', 'Failed');
          //  return redirect()->back();
        }
    }
}
