<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBlockedIp
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $blockedIps = \Illuminate\Support\Facades\Cache::rememberForever('blocked_ips', function () {
            return \App\Models\BlockedIp::pluck('ip_address')->toArray();
        });

        if (in_array($request->ip(), $blockedIps)) {
            abort(403, 'Akses Anda diblokir oleh administrator.');
        }

        return $next($request);
    }
}
