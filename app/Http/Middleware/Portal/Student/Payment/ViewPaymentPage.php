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
        $registration = $student->registration()->first();
        if($student != NULL && $registration->application_status != 'Declined'):
            if($registration->application_status != 'Approved' || $registration->payment_status != 'Approved'):
                return $next($request);
            else:
                return redirect('/portal/student/document/registration');
            endif;
        else:
            return redirect('/portal/student/registration');
        endif;
    }
}
