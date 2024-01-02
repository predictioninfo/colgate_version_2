<?php

namespace App\Http\Middleware\admin;

use Closure;
use App\Models\Permission;
use App\Models\User;
use App\Models\Package;
use Session;
use Auth;
use Illuminate\Http\Request;

class AnnualIncrement
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
        if (Permission::where('permission_com_id', Auth::user()->com_id)->where('permission_role_id', Auth::user()->role_id)
            ->whereRaw('json_contains(permission_content, \'["' . 15.7 . '"]\')')
            ->exists() || (Auth::user()->company_profile == 'Yes')
        ) {
            return $next($request);
        } else {
            // Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect('/home')->with('message', 'You Can Not Perform This Action.Please Contact Your It Officer');
        }
    }
}