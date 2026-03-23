<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\License;
use Illuminate\Http\Request;

class RequireLicense
{
    public function handle(Request $request, Closure $next)
    {
        // if (app()->runningInConsole()) {
        //     return $next($request);
        // }

        // if ($request->routeIs(
        //     'login',
        //     'register',
        //     'trial.blocked',
        //     'license.manager'
        // )) {
        //     return $next($request);
        // }

        // $license = License::first();
        // // dd($license);

        // // ❌ No license record → go to License Manager
        // if (! $license) {
        //     return redirect()->route('license.manager');
        // }

        // // 🔴 Trial revoked AND not restored
        // if ($license->trial_revoked_at && ! $license->trial_restored_at) {
        //     return redirect()->route('trial.blocked');
        // }

        // // 🟡 Trial expired (normal flow)
        // if (
        //     $license->trial_started_at &&
        //     now()->diffInDays($license->trial_started_at) > 14 &&
        //     ! $license->trial_restored_at
        // ) {
        //     return redirect()->route('license.manager');
        // }

        return $next($request);
    }
}
