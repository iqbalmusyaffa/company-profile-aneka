<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Merek</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #4F46E5; padding-bottom: 10px; }
        .title { font-size: 20px; font-weight: bold; color: #111827; margin: 0; }
        .subtitle { font-size: 12px; color: #6B7280; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #E5E7EB; padding: 10px; text-align: left; }
        th { background-color: #F9FAFB; font-weight: bold; color: #374151; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 10px; font-weight: bold; }
        .badge-active { background-color: #D1FAE5; color: #065F46; }
        .badge-inactive { background-color: #F3F4F6; color: #1F2937; }
        .footer { margin-top: 30px; font-size: 10px; color: #9CA3AF; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Laporan Analitik Merek</h1>
        <p class="subtitle">Dicetak pada: {{ date('d F Y H:i') }} | Total: {{ $brands->count() }} Merek</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Merek</th>
                <th class="text-center">Status</th>
                <th class="text-center">Jumlah Produk</th>
                <th class="text-center">Total Kunjungan</th>
                <th class="text-center">Rata-rata/Produk</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $index => $brand)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $brand->name }}</strong></td>
                <td class="text-center">
                    <span class="badge {{ $brand->is_active ? 'badge-active' : 'badge-inactive' }}">
                        {{ $brand->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="text-center">{{ $brand->products_count }}</td>
                <td class="text-center">{{ number_format($brand->products_sum_views ?? 0) }}</td>
                <td class="text-center">
                    {{ $brand->products_count > 0 ? number_format(($brand->products_sum_views ?? 0) / $brand->products_count, 1) : 0 }}
                </td>
                <td>{{ $brand->created_at ? $brand->created_at->format('d M Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak dari Sistem Admin Aneka Jaya &copy; {{ date('Y') }}
    </div>
</body>
</html>
