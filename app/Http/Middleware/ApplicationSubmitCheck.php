<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationSubmitCheck
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
        $uid = Auth::user()->id;
        $student = Student::where('user_id', $uid)->get()->first();
        if($student == NULL || ($student != NULL && is_null($student->registration->application_submit) || $student->registration->application_submit==0)):
            return $next($request);
        else:
            return redirect('/portal/student/payment/registration');
        endif;
    }
}
