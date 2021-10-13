<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XXXMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() == 'POST' || $request->method() == 'PUT') {
            $input = $request->all();
            array_walk_recursive($input, function (&$input) {
                $str  = $input;
                $searchVal = array("<script>", "</script>");
                $replaceVal = array(" ", " ");
                $input = str_replace($searchVal, $replaceVal, $str);
            });
            $request->merge($input);
            return $next($request);
        } else {
            $input = $request->all();
            array_walk_recursive($input, function (&$input) {
                $input = htmlentities($input);
            });
            $request->merge($input);
            return $next($request);
        }
    }
}
