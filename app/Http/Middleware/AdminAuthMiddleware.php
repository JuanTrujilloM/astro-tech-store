<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Middleware responsible for checking if the user is an admin 
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->getRole() == 'admin') {
            return $next($request);
        } else {
            return redirect()->route('home.index');
        }
    }
}
