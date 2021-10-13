<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AssignModulePermission;
use Illuminate\Support\Facades\Auth;

class UserRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $assignId = null)
    {
        if ((Auth::user()->role_id == 1)) {
            return $next($request);
        }
        // $permissions =   session()->get('permission');
        $check_permission =  AssignModulePermission::where('permission', 1)->where('role_id', Auth::user()->role_id)->get();

        $permissions = [];
        foreach ($check_permission as $key => $value) {
            $permissions[] = $value->module_id;
        }
        if ((!is_null($permissions)) &&  (Auth::user()->role_id != 1)) {
            if (in_array($assignId, $permissions)) {
                return $next($request);
            } else {
                abort('403');
            }
        } else {

            return $next($request);
        }
    }
}
