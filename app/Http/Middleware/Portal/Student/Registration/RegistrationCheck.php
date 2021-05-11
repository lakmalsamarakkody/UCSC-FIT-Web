<?php

namespace App\Http\Middleware\Portal\Student\Registration;

use App\Models\Student;
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
        $uid = Auth::user()->id;
        $student = Student::where('user_id', $uid)->first();
        if(is_null($student) || $student==null || ($student != NULL && $student->all_registrations()->first() == NULL)):
            return $next($request);
        elseif($student != NULL && $student->last_registration()):
            return redirect('/portal/student/payment/re-registration');
        else:
            return redirect('portal/student/');
        endif;
    }
}
