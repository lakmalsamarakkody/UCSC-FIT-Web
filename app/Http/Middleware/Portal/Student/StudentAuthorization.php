<?php

namespace App\Http\Middleware\Portal\Student;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthorization
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
        $role = Auth::user()->role->name;
        if($role=='Student'):
            return $next($request);
        else:
            return redirect('/login');
        endif;
    }
}
