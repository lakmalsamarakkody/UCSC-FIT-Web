<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationCheck
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
        $status = Auth::user()->status;
        if( $status == 0):
            return $next($request);
        elseif( $status == 1 ):
            return redirect('portal/student/');
        else:
            return redirect('/login');
        endif;
    }
}
