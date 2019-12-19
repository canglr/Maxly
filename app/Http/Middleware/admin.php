<?php

namespace App\Http\Middleware;

use App\Userroles;
use Closure;
use Illuminate\Support\Facades\Auth;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isRole('admin'))
        {
            return $next($request);
        }else{
            return response()->view('errors.403');
        }

    }
}
