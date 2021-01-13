<?php

namespace App\Http\Middleware\Portal\Student\Payment;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentSubmitCheck
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
        $registration = $student->registration()->where('registered_at', NULL)->where('status', NULL)->first();
        if($student != NULL && $registration->payment_id != NULL && $registration->application_status != 'Declined' && $registration->payment_status == 'Approved'):
            return $next($request);
        else:
            return redirect('/portal/student/registration');
        endif;
    }
}
