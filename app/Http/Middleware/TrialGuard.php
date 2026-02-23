<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\License;
use Symfony\Component\HttpFoundation\Response;

class TrialGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->runningInConsole()) {
            return $next($request);
        }

        if ($request->routeIs(
            'login',
            'register',
            'trial.restore',
            'trial.blocked'
        )) {
            return $next($request);
        }

        $license = License::first();

        if (! $license) {
            return $next($request);
        }

        if ($license->isTrialDisabled()) {
            return redirect()->route('trial.blocked');
        }

        return $next($request);
    }
}
