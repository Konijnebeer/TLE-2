<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**/

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is a teacher or admin
        if (!auth()->check() || (!auth()->user()->isTeacher() && !auth()->user()->isAdmin())) {
            abort(403);
        }
        return $next($request);
    }
}
