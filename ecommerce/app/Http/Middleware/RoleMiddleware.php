<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  mixed  ...$roles  // one or more roles passed from the route
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1) Not logged in -> redirect to login
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        // 2) Get current user role (null-safe)
        $userRole = Auth::user()->role ?? null;

        // 3) If no role or not in allowed roles -> deny
        if (! $userRole || ! in_array($userRole, $roles)) {
            // Option A: redirect back / home with message
            return redirect('/')->with('error', 'Access denied.');
            // Option B (alternative): abort(403);
            // abort(403, 'Unauthorized');
        }

        // 4) Allowed -> continue
        return $next($request);
    }
}
