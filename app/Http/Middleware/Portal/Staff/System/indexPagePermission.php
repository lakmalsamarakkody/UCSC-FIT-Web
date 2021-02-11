<?php

namespace App\Http\Middleware\Portal\Staff\System;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexPagePermission
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
        if(Auth::user()->hasPermission('staff-system')):
            return $next($request);
        else:
            return redirect('/portal/staff');
        endif;
    }
}
