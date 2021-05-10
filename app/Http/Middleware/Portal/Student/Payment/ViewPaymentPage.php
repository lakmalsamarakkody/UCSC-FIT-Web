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

        if($student && !$student->current_active_registration()):
            if(!$student->last_registration()):
                $registration = $student->registration()->first();
                if($registration->application_status != 'Declined'):
                    if($registration->payment_status != 'Approved'):
                        return $next($request);
                    else:
                        return redirect('/portal/student/document/registration');
                    endif;
                else:
                    return redirect('/portal/student/');
                endif;
            else:
                return $next($request);
            endif;
        else:
            return redirect('/portal/student/');
        endif;
    }
}
