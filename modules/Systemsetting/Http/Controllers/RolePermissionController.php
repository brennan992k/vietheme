<?php

namespace Modules\Systemsetting\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AssignModulePermission;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class RolePermissionController extends Controller
{
    
    
    public function role(Request $request)
    {
        try {
            $roles = Role::where('status', '=', 1)->where('id',2)->get();
            return view('backend.rolepermission.role_permission', compact('roles'));
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    
    
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function AssignRolePermission()
    {
        try {
            $role = Role::where('status', '=', 1)->where('id',2)->first();
            $modules=  DB::table('modules')
            ->join('assign_module_permissions','module_id','=','modules.id')
            -> select('modules.*','assign_module_permissions.permission')->get();
            // return $modules;
            return view('backend.rolepermission.assign_permission', compact('role','modules'));
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        
        try {
            return view('systemsetting::create');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function AssignRolePermissionUpdate(Request $request)
    {
        try {
            // return $request;
            foreach ($request->module_id as $module_id) {
                
                // return $permission[$module_id];
                $assign_permission = AssignModulePermission::where('module_id',$module_id)->first();
                // if ($request->permission != null) {
                //     $permission =1;
                // }else{
                //     $permission =0;
                // }
                //  return $request->permission[$module_id];
                // $permission = Input::has('permission')? 1: 0;
                if (isset($request->permission[$module_id])) {
                    // return $permission[$module_id];
                    $assign_permission->permission = 1;
                }else{
                    $assign_permission->permission = 0;
                }
                
                // return $assign_permission;
                // $assign_permission->permission = $permission;
                $assign_permission->update();
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        
        try {
            return view('systemsetting::show');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        
        try {
            return view('systemsetting::edit');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}