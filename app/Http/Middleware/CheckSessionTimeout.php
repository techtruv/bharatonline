<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // If user is authenticated
        if (Auth::check()) {
            // Get session timeout
            $timeout = Session::get('timeout');
            
            // Check if session has expired
            if ($timeout && now()->greaterThan($timeout)) {
                // Logout user
                Auth::logout();
                Session::flush();
                
                return redirect()->route('login')
                    ->with('session_warning', 'Your session has expired. Please login again.');
            }
            
            // Update last activity
            Session::put('last_activity', now());
        }

        return $next($request);
    }
}
