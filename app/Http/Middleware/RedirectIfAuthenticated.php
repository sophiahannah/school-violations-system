<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = [
            'student' => 1,
            'faculty' => 2
        ];

        if (Auth::check()) {
            if (Auth::user()->role_id === $roles['student']) {
                return redirect()->route('student.dashboard.index');
            } else if (Auth::user()->role_id === $roles['faculty']) {
                return redirect()->route('admin.dashboard.index');
            }
        }
        return $next($request);
    }
}
