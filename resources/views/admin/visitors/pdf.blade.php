<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengunjung Toko Bangunan Aneka Jaya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #1f2937;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #6b7280;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
            color: #1f2937;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #9ca3af;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <div class="header">
        @if(!empty($settings['store_logo']) && file_exists(public_path('storage/' . $settings['store_logo'])))
            <img src="{{ public_path('storage/' . $settings['store_logo']) }}" style="max-height: 60px; margin-bottom: 10px;">
        @endif
        <h1>Laporan Data Pengunjung Website</h1>
        <p>{{ $settings['store_name'] ?? 'Toko Bangunan Aneka Jaya' }}</p>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d M Y') }}</p>
        <p>Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i:s') }}</p>
    </div>

    @if(isset($analysisText))
    <div style="margin-bottom: 25px; padding: 15px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 5px;">
        <h3 style="margin-top: 0; margin-bottom: 10px; color: #1e293b; font-size: 14px;">Ringkasan Analisa</h3>
        <p style="margin: 0; line-height: 1.5; color: #475569; font-size: 12px; text-align: justify;">{{ $analysisText }}</p>
    </div>
    @endif

    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin-bottom: 5px;">Statistik Pengunjung</h3>
        <img src="{{ $lineChartBase64 }}" style="width: 100%; max-width: 600px; height: auto;">
    </div>

    <div style="width: 100%; display: table; margin-bottom: 30px;">
        <div style="display: table-cell; width: 50%; text-align: center;">
            <h4 style="margin-bottom: 5px;">Distribusi Browser</h4>
            <img src="{{ $browserChartBase64 }}" style="width: 250px; height: auto;">
        </div>
        <div style="display: table-cell; width: 50%; text-align: center;">
            <h4 style="margin-bottom: 5px;">Distribusi Perangkat</h4>
            <img src="{{ $deviceChartBase64 }}" style="width: 250px; height: auto;">
        </div>
    </div>

    <div class="page-break"></div>

    <h3 style="margin-bottom: 10px;">Data Teratas</h3>
    <div style="width: 100%; display: table; margin-bottom: 30px;">
        <div style="display: table-cell; width: 48%; padding-right: 2%;">
            <h4>Halaman Terpopuler</h4>
            <table>
                <thead>
                    <tr>
                        <th>URL Halaman</th>
                        <th width="30%">Views</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topPages as $page)
                    <tr>
                        <td>/{{ $page->url }}</td>
                        <td style="text-align: center;">{{ number_format($page->total_hits) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="text-align: center;">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="display: table-cell; width: 50%;">
            <h4>Lokasi Teratas</h4>
            <table>
                <thead>
                    <tr>
                        <th>Kota / Negara</th>
                        <th width="30%">Pengunjung</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topLocations as $loc)
                    <tr>
                        <td>{{ $loc->city }}, {{ $loc->country }}</td>
                        <td style="text-align: center;">{{ number_format($loc->visitors) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="text-align: center;">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h3 style="margin-bottom: 10px;">Log Detail Kunjungan</h3>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">IP Address</th>
                <th width="15%">Page Views</th>
                <th width="45%">Lokasi / Peramban</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitors as $index => $visitor)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('d/m/Y') }}</td>
                <td>{{ $visitor->ip_address }}</td>
                <td style="text-align: center;">{{ $visitor->hits }}</td>
                <td>
                    @if($visitor->city)
                        <strong>{{ $visitor->city }}, {{ $visitor->country }}</strong><br>
                    @endif
                    {{ \Illuminate\Support\Str::limit($visitor->user_agent, 50) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dihasilkan oleh Sistem Admin {{ $settings['store_name'] ?? 'Toko Bangunan Aneka Jaya' }}
    </div>

</body>
</html>
