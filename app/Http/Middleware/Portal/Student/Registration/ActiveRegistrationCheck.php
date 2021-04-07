<?php

namespace App\Http\Middleware\Portal\Student\Registration;

use App\Models\Student;
use App\Models\Student\Registration;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class ActiveRegistrationCheck
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
        $student = Auth::user()->student;
        if( $student != Null && $student->current_active_registration()):
            return $next($request);
        else:
            return redirect('/portal/student/registration');
        endif;
    }
}
