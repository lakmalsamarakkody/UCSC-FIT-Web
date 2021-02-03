<?php

namespace App\Http\Middleware\Portal\Staff;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthorization
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
        $role = Auth::user()->role_id;
        if($role!=1):
            return $next($request);
        else:
            return redirect('/login');
        endif;
    }
}
