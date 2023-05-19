<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('login')) {
            // Allow the request to proceed without checking for the admin role
            return $next($request);
        }

        if (Auth::check() && Auth::user()->account_role_id == 1) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->account_role_id == 0) {
            return Redirect::route('super_admin_dashboard');
        }

        Auth::logout();
        return redirect('/login');
    }
}
