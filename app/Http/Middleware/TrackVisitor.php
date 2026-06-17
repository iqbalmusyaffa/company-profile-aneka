<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && !$request->is('admin/*') && !$request->ajax()) {
            $ip = $request->ip();
            $date = now()->toDateString();

            // Try to get location
            $city = null;
            $country = null;
            try {
                if ($location = \Stevebauman\Location\Facades\Location::get($ip)) {
                    $city = $location->cityName;
                    $country = $location->countryName;
                }
            } catch (\Exception $e) {
                // Ignore location errors
            }

            // Track Visitor
            $visitor = \App\Models\Visitor::firstOrCreate(
                ['ip_address' => $ip, 'visit_date' => $date],
                ['user_agent' => $request->userAgent(), 'city' => $city, 'country' => $country, 'hits' => 0]
            );
            $visitor->increment('hits');
            
            if (!$visitor->city && $city) {
                $visitor->update(['city' => $city, 'country' => $country]);
            }

            // Track Page View
            $pageView = \App\Models\PageView::firstOrCreate(
                ['url' => $request->path(), 'visit_date' => $date],
                ['hits' => 0]
            );
            $pageView->increment('hits');
        }

        return $next($request);
    }
}
