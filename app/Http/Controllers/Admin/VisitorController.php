<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date', now()->subDays(29)->toDateString());
        $endDate = $request->query('end_date', now()->toDateString());
        $cacheKey = "visitor_dashboard_{$startDate}_{$endDate}";

        // Use cache for dashboard data (15 minutes)
        $data = Cache::remember($cacheKey, 900, function() use ($startDate, $endDate) {
            // 1. Chart Data
            $visitorData = \App\Models\Visitor::selectRaw('visit_date, COUNT(*) as unique_visitors, SUM(hits) as page_views')
                ->whereBetween('visit_date', [$startDate, $endDate])
                ->groupBy('visit_date')
                ->orderBy('visit_date', 'ASC')
                ->get();

            $chartLabels = [];
            $chartUniqueVisitors = [];
            $chartPageViews = [];

            $currentDate = \Carbon\Carbon::parse($startDate);
            $end = \Carbon\Carbon::parse($endDate);
            
            while ($currentDate <= $end) {
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

            // 2. Browser & Device Usage Data (Pie Chart)
            $browserDataRaw = \App\Models\Visitor::whereBetween('visit_date', [$startDate, $endDate])->pluck('user_agent');
            $browsers = ['Chrome' => 0, 'Firefox' => 0, 'Safari' => 0, 'Edge' => 0, 'Opera' => 0, 'Lainnya' => 0];
            $devices = ['Desktop' => 0, 'Mobile' => 0, 'Tablet' => 0];

            foreach ($browserDataRaw as $ua) {
                $ua = strtolower($ua);
                if (strpos($ua, 'edge') !== false || strpos($ua, 'edg') !== false) $browsers['Edge']++;
                elseif (strpos($ua, 'opera') !== false || strpos($ua, 'opr') !== false) $browsers['Opera']++;
                elseif (strpos($ua, 'chrome') !== false) $browsers['Chrome']++;
                elseif (strpos($ua, 'firefox') !== false) $browsers['Firefox']++;
                elseif (strpos($ua, 'safari') !== false && strpos($ua, 'chrome') === false) $browsers['Safari']++;
                else $browsers['Lainnya']++;

                if (strpos($ua, 'tablet') !== false || strpos($ua, 'ipad') !== false) $devices['Tablet']++;
                elseif (strpos($ua, 'mobile') !== false || strpos($ua, 'android') !== false || strpos($ua, 'iphone') !== false) $devices['Mobile']++;
                else $devices['Desktop']++;
            }

            $browserChartData = ['labels' => array_keys($browsers), 'data' => array_values($browsers)];
            $deviceChartData = ['labels' => array_keys($devices), 'data' => array_values($devices)];

            // 3. Day of Week Data (Bar Chart)
            $dayOfWeekStats = ['Senin' => 0, 'Selasa' => 0, 'Rabu' => 0, 'Kamis' => 0, 'Jumat' => 0, 'Sabtu' => 0, 'Minggu' => 0];
            $allVisitors = \App\Models\Visitor::whereBetween('visit_date', [$startDate, $endDate])->get();
            foreach ($allVisitors as $v) {
                $dayName = \Carbon\Carbon::parse($v->visit_date)->translatedFormat('l');
                if (isset($dayOfWeekStats[$dayName])) {
                    $dayOfWeekStats[$dayName] += $v->hits;
                }
            }
            $dayChartData = ['labels' => array_keys($dayOfWeekStats), 'data' => array_values($dayOfWeekStats)];

            // Top pages is moved outside cache to support pagination

            return compact('chartData', 'browserChartData', 'deviceChartData', 'dayChartData');
        });

        extract($data);

        // 4. Top Pages (Paginated)
        $topPages = \App\Models\PageView::whereBetween('visit_date', [$startDate, $endDate])
            ->selectRaw('url, SUM(hits) as total_hits')
            ->groupBy('url')
            ->orderBy('total_hits', 'DESC')
            ->paginate(10, ['*'], 'top_page');
            
        $topPages->appends(request()->query());

        // 5. Locations (Paginated)
        $topLocations = \App\Models\Visitor::whereBetween('visit_date', [$startDate, $endDate])
            ->whereNotNull('city')
            ->selectRaw('city, country, COUNT(*) as visitors')
            ->groupBy('city', 'country')
            ->orderBy('visitors', 'DESC')
            ->paginate(5, ['*'], 'locations_page');
        $topLocations->appends(request()->query());

        // Raw Logs
        $visitors = \App\Models\Visitor::whereBetween('visit_date', [$startDate, $endDate])
            ->orderBy('visit_date', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);
            
        $visitors->appends(['start_date' => $startDate, 'end_date' => $endDate]);

        // Blocked IPs
        $blockedIps = \App\Models\BlockedIp::pluck('ip_address')->toArray();

        return view('admin.visitors.index', compact('chartData', 'browserChartData', 'deviceChartData', 'dayChartData', 'visitors', 'startDate', 'endDate', 'topPages', 'topLocations', 'blockedIps'));
    }

    public function exportPdf(Request $request)
    {
        if ($request->has('tz')) {
            $tz = $request->query('tz');
            config(['app.timezone' => $tz]);
            date_default_timezone_set($tz);
        }

        $startDate = $request->query('start_date', now()->subDays(29)->toDateString());
        $endDate = $request->query('end_date', now()->toDateString());

        $visitors = \App\Models\Visitor::whereBetween('visit_date', [$startDate, $endDate])
            ->orderBy('visit_date', 'DESC')
            ->get();
        
        // Settings for dynamic logo
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        // 1. Line Chart
        $visitorData = \App\Models\Visitor::selectRaw('visit_date, COUNT(*) as unique_visitors, SUM(hits) as page_views')
            ->whereBetween('visit_date', [$startDate, $endDate])->groupBy('visit_date')->orderBy('visit_date', 'ASC')->get();
            
        $labels = []; $pageViews = []; $uniqueVisitors = [];
        $currentDate = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);
        
        while ($currentDate <= $end) {
            $dateStr = $currentDate->toDateString();
            $labels[] = $currentDate->format('d M');
            $dayData = $visitorData->firstWhere('visit_date', $dateStr);
            $pageViews[] = $dayData ? $dayData->page_views : 0;
            $uniqueVisitors[] = $dayData ? $dayData->unique_visitors : 0;
            $currentDate->addDay();
        }

        $chartConfig = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    ['label' => 'Page Views', 'data' => $pageViews, 'borderColor' => '#06b6d4', 'fill' => false],
                    ['label' => 'Pengunjung Unik', 'data' => $uniqueVisitors, 'borderColor' => '#3b82f6', 'fill' => false]
                ]
            ]
        ];
        $lineChartUrl = 'https://quickchart.io/chart?w=600&h=300&c=' . urlencode(json_encode($chartConfig));
        $lineChartBase64 = 'data:image/png;base64,' . base64_encode(@file_get_contents($lineChartUrl));

        // 2. Browser Pie Chart
        $browsers = ['Chrome' => 0, 'Firefox' => 0, 'Safari' => 0, 'Edge' => 0, 'Opera' => 0, 'Lainnya' => 0];
        foreach ($visitors->pluck('user_agent') as $ua) {
            $ua = strtolower($ua);
            if (strpos($ua, 'edge') !== false || strpos($ua, 'edg') !== false) $browsers['Edge']++;
            elseif (strpos($ua, 'opera') !== false || strpos($ua, 'opr') !== false) $browsers['Opera']++;
            elseif (strpos($ua, 'chrome') !== false) $browsers['Chrome']++;
            elseif (strpos($ua, 'firefox') !== false) $browsers['Firefox']++;
            elseif (strpos($ua, 'safari') !== false && strpos($ua, 'chrome') === false) $browsers['Safari']++;
            else $browsers['Lainnya']++;
        }
        $browserConfig = [
            'type' => 'doughnut',
            'data' => ['labels' => array_keys($browsers), 'datasets' => [['data' => array_values($browsers)]]]
        ];
        $browserChartUrl = 'https://quickchart.io/chart?w=300&h=300&c=' . urlencode(json_encode($browserConfig));
        $browserChartBase64 = 'data:image/png;base64,' . base64_encode(@file_get_contents($browserChartUrl));

        // 3. Device Pie Chart
        $devices = ['Desktop' => 0, 'Mobile' => 0, 'Tablet' => 0];
        foreach ($visitors->pluck('user_agent') as $ua) {
            $ua = strtolower($ua);
            if (strpos($ua, 'tablet') !== false || strpos($ua, 'ipad') !== false) $devices['Tablet']++;
            elseif (strpos($ua, 'mobile') !== false || strpos($ua, 'android') !== false || strpos($ua, 'iphone') !== false) $devices['Mobile']++;
            else $devices['Desktop']++;
        }
        $deviceConfig = [
            'type' => 'doughnut',
            'data' => ['labels' => array_keys($devices), 'datasets' => [['data' => array_values($devices)]]]
        ];
        $deviceChartUrl = 'https://quickchart.io/chart?w=300&h=300&c=' . urlencode(json_encode($deviceConfig));
        $deviceChartBase64 = 'data:image/png;base64,' . base64_encode(@file_get_contents($deviceChartUrl));

        // Generate Analysis Text
        $totalPageViews = count($pageViews) > 0 ? array_sum($pageViews) : 0;
        $totalUniqueVisitors = count($uniqueVisitors) > 0 ? array_sum($uniqueVisitors) : 0;
        
        $maxPageViews = count($pageViews) > 0 ? max($pageViews) : 0;
        $peakDay = '-';
        if ($maxPageViews > 0) {
            $maxIndex = array_search($maxPageViews, $pageViews);
            $peakDay = $labels[$maxIndex] ?? '-';
        }
        
        arsort($browsers);
        $topBrowser = key($browsers);
        $topBrowserCount = current($browsers);
        $totalBrowsers = array_sum($browsers);
        $browserPct = $totalBrowsers > 0 ? round(($topBrowserCount / $totalBrowsers) * 100) : 0;
        
        arsort($devices);
        $topDevice = key($devices);
        $topDeviceCount = current($devices);
        $totalDevices = array_sum($devices);
        $devicePct = $totalDevices > 0 ? round(($topDeviceCount / $totalDevices) * 100) : 0;

        $analysisText = "Berdasarkan rentang waktu " . \Carbon\Carbon::parse($startDate)->format('d/m/Y') . " hingga " . \Carbon\Carbon::parse($endDate)->format('d/m/Y') . ", website mendapatkan total kunjungan sebanyak {$totalUniqueVisitors} pengunjung unik dengan {$totalPageViews} halaman yang dilihat (page views). ";
        if ($maxPageViews > 0) {
            $analysisText .= "Hari dengan lalu lintas tertinggi terjadi pada {$peakDay} dengan {$maxPageViews} page views. ";
        }
        if ($totalDevices > 0) {
            $analysisText .= "Mayoritas pengunjung mengakses website menggunakan perangkat {$topDevice} ({$devicePct}%) dan peramban {$topBrowser} ({$browserPct}%).";
        } else {
            $analysisText .= "Belum ada data perangkat dan peramban yang tercatat.";
        }

        $topPages = \App\Models\PageView::whereBetween('visit_date', [$startDate, $endDate])
            ->selectRaw('url, SUM(hits) as total_hits')
            ->groupBy('url')
            ->orderBy('total_hits', 'DESC')
            ->limit(10)
            ->get();

        $topLocations = \App\Models\Visitor::whereBetween('visit_date', [$startDate, $endDate])
            ->whereNotNull('city')
            ->selectRaw('city, country, COUNT(*) as visitors')
            ->groupBy('city', 'country')
            ->orderBy('visitors', 'DESC')
            ->limit(10)
            ->get();

        // Load PDF View
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.visitors.pdf', compact('visitors', 'lineChartBase64', 'browserChartBase64', 'deviceChartBase64', 'analysisText', 'settings', 'startDate', 'endDate', 'topPages', 'topLocations'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption(['isRemoteEnabled' => true]);

        return $pdf->download('laporan_pengunjung_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        if ($request->has('tz')) {
            $tz = $request->query('tz');
            config(['app.timezone' => $tz]);
            date_default_timezone_set($tz);
        }
        
        $startDate = $request->query('start_date', now()->subDays(29)->toDateString());
        $endDate = $request->query('end_date', now()->toDateString());

        // Update Excel export logic to use dates
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\VisitorsExport($startDate, $endDate), 'laporan_pengunjung_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function blockIp(Request $request)
    {
        $request->validate(['ip_address' => 'required|ip']);
        \App\Models\BlockedIp::firstOrCreate(
            ['ip_address' => $request->ip_address],
            ['reason' => $request->reason ?? 'Diblokir dari dashboard administrator']
        );
        return back()->with('success', 'IP Address ' . $request->ip_address . ' berhasil diblokir.');
    }

    public function unblockIp($ip)
    {
        \App\Models\BlockedIp::where('ip_address', $ip)->delete();
        return back()->with('success', 'Blokir untuk IP Address ' . $ip . ' berhasil dibuka.');
    }
}
