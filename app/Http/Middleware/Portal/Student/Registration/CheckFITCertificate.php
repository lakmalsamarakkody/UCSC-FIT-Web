<?php

namespace App\Http\Middleware\Portal\Student\Registration;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFITCertificate
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
        if (Auth::user()->student->flag->fit_cert == 0) :
            return $next($request);
        else:
            return redirect('portal/student/');
        endif;
        
    }
}
