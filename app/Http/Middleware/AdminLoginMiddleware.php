<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
        if (Auth::check()) 
        {
            $user = Auth::user();
            if($user->is_permission ==2)
            {
                return $next($request);
            }
                return response()->view('errors.check-permission');
        }
        else
            return response()->view('errors.check-permission');
        
    }
}
