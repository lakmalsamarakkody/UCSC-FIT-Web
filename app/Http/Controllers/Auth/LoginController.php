<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/portal/staff/';

    public function redirectTo(){
        $role = Auth::user()->role->name;
        $status= Auth::user()->status;
        if($status != 0):
            activity()->log('login');
            switch ($role):
                case 'Student':
                    $student = Student::where('user_id', Auth::user()->id)->first();
                    if($student == NULL || $student->registration->first()->status == NULL):
                        return '/portal/student/registration';
                    else:
                        return '/portal/student';
                    endif;
                    break;
                default:
                    return '/portal/staff';
                    break;
            endswitch;
        else:
            return abort(403);
        endif;
    }

    public function logout(Request $request)
    {
        activity()->log('logout');
        return redirect('/login')->with(Auth::logout());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
