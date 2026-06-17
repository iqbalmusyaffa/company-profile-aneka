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
        if (\App\Models\BlockedIp::where('ip_address', $request->ip())->exists()) {
            abort(403, 'Akses Anda diblokir oleh administrator.');
        }

        return $next($request);
    }
}
