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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirect if not logged in
        }
        // dd($role);
        $user = Auth::user();
        if ($user->role !== $role) {
            return redirect('/'); // Redirect if the user doesn't have the required role
        }

        return $next($request);
    }
}
