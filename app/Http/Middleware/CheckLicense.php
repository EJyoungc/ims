<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // 🚨 Skip console commands
        if (app()->runningInConsole()) {
            return $next($request);
        }
        // dd('test');
        // 🚨 Exempt routes to avoid redirect loops
        // if ($request->routeIs(
        //     // 'login',
        //     'register',
        //     'password.*',
        //     'license.*'
        // )) {
        //     dd('test');
        //     return $next($request);
        // }

        // // ✅ License validation
        // if (! session('license_valid', false)) {
        //     return redirect()->route('license.expired');
        // }

        return $next($request);
    }

}
