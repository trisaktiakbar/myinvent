<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TimePlannerHO
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            Auth::user()->role != 'Admin'
            && Auth::user()->role != 'Permintaan Barang'
            && Auth::user()->role != 'Time Planner HO'
        ) {
            return redirect('/');
        }

        return $next($request);
    }
}
