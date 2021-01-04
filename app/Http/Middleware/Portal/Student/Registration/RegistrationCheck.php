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
        $student = Student::select('reg_no')->where('user_id', $uid)->first();
        if(is_null($student) || $student==null || ($student != NULL && $student->reg_no == NULL)):
            return $next($request);
        else:
            return redirect('portal/student/');
        endif;
    }
}
