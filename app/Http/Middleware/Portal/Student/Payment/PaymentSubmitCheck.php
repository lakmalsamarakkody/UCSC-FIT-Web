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
        $uid = Auth::user()->id;
        $student = Student::where('user_id', $uid)->first();
        if($student != NULL && $student->registration->first()->payment_id != NULL && $student->registration->first()->application_status != 'Declined'):
            return $next($request);
        elseif ($student == NULL || $student->registration->first()->application_status != 'Approved'):
            return redirect('/portal/student/registration');
        else:
            return redirect('/portal/student/payment/registration');
        endif;
    }
}
