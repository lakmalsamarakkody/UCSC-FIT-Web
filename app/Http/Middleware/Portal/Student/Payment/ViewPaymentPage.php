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
        $student = Student::where('user_id', $uid)->get()->first();
        if($student != NULL && (is_null($student->flag->payment_submit) || $student->flag->payment_submit==null)):
            return $next($request);
        else:
            return redirect('/portal/student/document/registration');
        endif;
    }
}
