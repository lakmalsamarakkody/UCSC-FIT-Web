<?php

namespace App\Http\Middleware\Portal\Student\Payment;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewPaymentPage
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
        if($student != NULL && $student->registration->first()->application_status != 'Declined'):
            if($student->registration->first()->payment_status != 'Approved'):
                return $next($request);
            else:
                return redirect('/portal/student/document/registration');
            endif;
        else:
            return redirect('/portal/student/registration');
        endif;
    }
}
