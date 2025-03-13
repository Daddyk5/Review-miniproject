<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Check if user is authenticated and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Allow access
        }

        // ❌ If not admin, deny access
        abort(403, 'Unauthorized access.');
    }
}
