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
        $uid = Auth::user()->id;
        $student = Student::where('user_id', $uid)->first();
        $registration = Registration::where('student_id', $student->id)->latest()->first();
        if($registration != NULL && $registration->registration_expire_at !=Null && $registration->registration_expire_at >= date('Y-m-d') && $registration->status == 1 ):
            return $next($request);
        else:
            return redirect('/portal/student/');
        endif;
    }
}
