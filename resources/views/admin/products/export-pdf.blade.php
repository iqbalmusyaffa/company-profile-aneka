<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2a6396;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            color: #1b3854;
            font-size: 18px;
        }
        .header p {
            margin: 0;
            color: #666;
            font-size: 10px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 6px 4px;
            text-align: left;
            vertical-align: top;
        }
        .data-table th {
            background-color: #f0f5fa;
            color: #2a6396;
            font-weight: bold;
        }
        .data-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .card-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px;
        }
        .card-title {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .card-value {
            font-size: 16px;
            color: #0f172a;
            font-weight: bold;
        }
        .card-value-red { color: #ef4444; }
        .card-value-green { color: #059669; }

        .section-title {
            font-size: 12px;
            color: #1e293b;
            font-weight: bold;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 4px;
            font-size: 8px;
            font-weight: bold;
            color: white;
        }
        .badge-active { background-color: #22c55e; }
        .badge-draft { background-color: #64748b; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN DATA PRODUK</h2>
        <p>Toko Bangunan Aneka Jaya | Tanggal Cetak: {{ now()->format('d M Y H:i') }}</p>
    </div>

    <!-- SUMMARY CARDS (Using Table layout for DomPDF compatibility) -->
    <table style="width: 100%; border: none; margin-bottom: 20px;" cellspacing="0" cellpadding="0">
        <tr>
            <td width="19%" class="card-box">
                <div class="card-title">Nilai Inventaris</div>
                <div class="card-value card-value-green">Rp{{ number_format($analysis['total_asset_value'] ?? 0, 0, ',', '.') }}</div>
            </td>
            <td width="1.25%" style="border: none;"></td>
            <td width="19%" class="card-box">
                <div class="card-title">Total Produk</div>
                <div class="card-value">{{ $analysis['total_products'] }}</div>
            </td>
            <td width="1.25%" style="border: none;"></td>
            <td width="19%" class="card-box">
                <div class="card-title">Total Dilihat</div>
                <div class="card-value">{{ number_format($analysis['total_views'], 0, ',', '.') }}</div>
            </td>
            <td width="1.25%" style="border: none;"></td>
            <td width="19%" class="card-box">
                <div class="card-title">Rata-rata Harga</div>
                <div class="card-value">Rp{{ number_format($analysis['avg_price'], 0, ',', '.') }}</div>
            </td>
            <td width="1.25%" style="border: none;"></td>
            <td width="19%" class="card-box">
                <div class="card-title">Stok Menipis</div>
                <div class="card-value card-value-red">{{ $analysis['low_stock'] }} Item</div>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="15%">Nama Produk</th>
                <th width="10%">SKU</th>
                <th width="10%">Kategori</th>
                <th width="10%">Merek</th>
                <th width="5%" class="text-center">Stok</th>
                <th width="10%" class="text-right">Harga Asli</th>
                <th width="10%" class="text-right">Harga Jual</th>
                <th width="8%" class="text-center">Dilihat</th>
                <th width="7%" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku ?? '-' }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>{{ $product->brand->name ?? '-' }}</td>
                <td class="text-center">{{ $product->stock }}</td>
                <td class="text-right">Rp {{ number_format($product->original_price, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $product->views ?? 0 }}</td>
                <td class="text-center">
                    @if($product->is_active)
                        <span class="badge badge-active">Aktif</span>
                    @else
                        <span class="badge badge-draft">Draft</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="page-break-inside: avoid;">
        <table style="width: 100%; border: none; margin-top: 15px;" cellspacing="0" cellpadding="0">
            <tr>
                <!-- CHART CONTAINER -->
                <td width="48%" class="card-box" style="vertical-align: top;">
                    <div class="section-title">Distribusi Kategori</div>
                    @if(isset($base64Chart) && $base64Chart)
                        <div style="text-align: center; margin-top: 10px;">
                            <img src="{{ $base64Chart }}" style="max-width: 100%; height: auto;">
                        </div>
                    @else
                        <p style="color:#999; text-align:center; padding: 20px 0;">Tidak ada data grafik</p>
                    @endif
                </td>
                
                <td width="4%" style="border: none;"></td>

                <!-- TOP PRODUCTS -->
                <td width="48%" class="card-box" style="vertical-align: top;">
                    <div class="section-title">Top 3 Produk Populer</div>
                    @if($analysis['top_products']->count() > 0)
                        <table style="width: 100%; border: none; margin: 0;">
                            @foreach($analysis['top_products'] as $idx => $top)
                                <tr>
                                    <td style="border: none; padding: 5px 0; border-bottom: 1px solid #eee;">
                                        <strong>{{ $idx + 1 }}. {{ $top->name }}</strong><br>
                                        <span style="color: #666; font-size: 9px;">Kategori: {{ $top->category->name ?? '-' }}</span>
                                    </td>
                                    <td style="border: none; padding: 5px 0; border-bottom: 1px solid #eee; text-align: right; vertical-align: middle;">
                                        <span style="background-color: #eff6ff; color: #2563eb; padding: 2px 6px; font-weight: bold; font-size: 9px;">
                                            {{ number_format($top->views ?? 0, 0, ',', '.') }} views
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p style="color:#999; text-align:center; padding: 20px 0;">Belum ada data</p>
                    @endif
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
