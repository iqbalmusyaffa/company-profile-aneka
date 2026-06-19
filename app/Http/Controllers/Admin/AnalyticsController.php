<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageView;
use App\Models\Visitor;
use App\Models\SeoPage;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // 1. Top Pages/Products (Most viewed URLs)
        $topPages = PageView::select('url', DB::raw('SUM(hits) as total_hits'))
            ->groupBy('url')
            ->orderByDesc('total_hits')
            ->paginate(10);

        // 2. SEO Health Check
        // Get pages that might need SEO attention (e.g. missing meta description)
        $seoPagesNeedsAttention = SeoPage::whereNull('meta_description')
            ->orWhere('meta_description', '')
            ->orWhereNull('meta_title')
            ->orWhere('meta_title', '')
            ->get();

        $totalSeoPages = SeoPage::count();

        // 3. Traffic Sources (Top Cities/Countries)
        $topCities = Visitor::select('city', DB::raw('COUNT(id) as total_visitors'))
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderByDesc('total_visitors')
            ->limit(5)
            ->get();

        $topCountries = Visitor::select('country', DB::raw('COUNT(id) as total_visitors'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('total_visitors')
            ->limit(5)
            ->get();

        // 4. Visitors by Device (Parsed from user_agent roughly)
        $mobileVisitors = Visitor::where('user_agent', 'like', '%Mobile%')
            ->orWhere('user_agent', 'like', '%Android%')
            ->orWhere('user_agent', 'like', '%iPhone%')
            ->count();
            
        $totalVisitors = Visitor::count();
        $desktopVisitors = $totalVisitors > 0 ? ($totalVisitors - $mobileVisitors) : 0;

        return view('admin.analytics.index', compact(
            'topPages',
            'seoPagesNeedsAttention',
            'totalSeoPages',
            'topCities',
            'topCountries',
            'mobileVisitors',
            'desktopVisitors',
            'totalVisitors'
        ));
    }
}
