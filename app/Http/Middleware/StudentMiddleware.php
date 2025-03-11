<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('sign-in')->with('error', 'You must be logged in to access this page.');
        }

        // Check if user has the role
        $user = Auth::user();
        if ($user->role !== "student") {
            Auth::logout();
            return redirect('sign-in')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
