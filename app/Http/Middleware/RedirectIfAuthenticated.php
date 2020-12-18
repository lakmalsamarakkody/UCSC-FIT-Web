<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null){
        if (Auth::guard($guard)->check()):
             $role = Auth::user()->role->name;
             $status= Auth::user()->status;
             switch ($role):
                 case 'Student':
                     if($status==0):
                         return '/portal/student/registration';
                     else:
                         return '/portal/student';
                     endif;
                   break;           
                default:
                   return redirect('/portal/staff/'); 
                   break;
            endswitch;
        endif;
        
        return $next($request);
    }




    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return redirect('RouteServiceProvider::HOME');
    //         }
    //     }

    //     return $next($request);
    // }
}
