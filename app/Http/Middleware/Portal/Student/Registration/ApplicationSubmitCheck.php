<?php

namespace App\Http\Middleware\Portal\Student\Registration;

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
        $student = Student::where('user_id', $uid)->first();
        if($student == NULL || ($student != NULL && $student->registration->first()->application_submit == 0)):
            return $next($request);
        else:
            return redirect('/portal/student/payment/registration');
        endif;
    }
}
