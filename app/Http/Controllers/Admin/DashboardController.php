<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => \App\Models\Product::count(),
            'total_categories' => \App\Models\Category::count(),
            'total_brands' => \App\Models\Brand::count(),
            'total_posts' => \App\Models\Post::count(),
            'total_visitors' => \App\Models\Visitor::count(),
            'today_visitors' => \App\Models\Visitor::whereDate('visit_date', now()->toDateString())->count(),
        ];

        // Chart Data (Last 30 Days)
        $thirtyDaysAgo = now()->subDays(30)->toDateString();
        $visitorData = \App\Models\Visitor::selectRaw('visit_date, COUNT(*) as unique_visitors, SUM(hits) as page_views')
            ->where('visit_date', '>=', $thirtyDaysAgo)
            ->groupBy('visit_date')
            ->orderBy('visit_date', 'ASC')
            ->get();

        $chartLabels = [];
        $chartUniqueVisitors = [];
        $chartPageViews = [];

        // Fill missing days with 0
        $currentDate = now()->subDays(29);
        while ($currentDate <= now()) {
            $dateStr = $currentDate->toDateString();
            $chartLabels[] = $currentDate->format('d M');
            
            $dayData = $visitorData->firstWhere('visit_date', $dateStr);
            $chartUniqueVisitors[] = $dayData ? $dayData->unique_visitors : 0;
            $chartPageViews[] = $dayData ? $dayData->page_views : 0;

            $currentDate->addDay();
        }

        $chartData = [
            'labels' => $chartLabels,
            'unique_visitors' => $chartUniqueVisitors,
            'page_views' => $chartPageViews,
        ];

        return view('admin.dashboard', compact('stats', 'chartData'));
    }
}
