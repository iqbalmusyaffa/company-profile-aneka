@extends('layouts.admin')

@section('title', 'Laporan & Analisa Produk')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Laporan Produk</h2>
        <p class="text-gray-500 text-sm mt-1">Analisa performa katalog produk Anda berdasarkan filter.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.products.export.pdf', request()->query()) }}" target="_blank" class="bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-red-500/30 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            Export PDF
        </a>
        <a href="{{ route('admin.products.export.excel', request()->query()) }}" target="_blank" class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-green-500/30 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export Excel
        </a>
    </div>
</div>

<!-- Filter Form -->
<form method="GET" action="{{ route('admin.products.report') }}" class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 mb-8 flex flex-wrap gap-4 items-end">
    <div class="flex-1 min-w-[200px]">
        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kategori Produk</label>
        <select name="category_id" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors text-gray-700 font-medium">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 min-w-[200px]">
        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status Produk</label>
        <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors text-gray-700 font-medium">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif Dijual</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft / Disembunyikan</option>
        </select>
    </div>
    <div class="flex gap-3">
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2.5 px-6 rounded-xl transition-colors shadow-lg shadow-primary-500/30">
            Terapkan Filter
        </button>
        @if(request()->hasAny(['category_id', 'status']))
        <a href="{{ route('admin.products.report') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 px-6 rounded-xl transition-colors">
            Reset
        </a>
        @endif
    </div>
</form>

<!-- Analysis Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
    
    <div class="relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 overflow-hidden hover:-translate-y-1 transition-transform duration-300">
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-indigo-50 rounded-full blur-2xl opacity-60"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full border border-gray-100">Aset</span>
            </div>
            <p class="text-sm font-semibold text-gray-500 mb-1">Nilai Inventaris</p>
            <h3 class="text-2xl font-extrabold text-gray-900 truncate" title="Rp {{ number_format($analysis['total_asset_value'], 0, ',', '.') }}">
                Rp {{ number_format($analysis['total_asset_value'], 0, ',', '.') }}
            </h3>
            <p class="text-xs text-gray-400 mt-2">Harga x Stok saat ini</p>
        </div>
    </div>

    <div class="relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 overflow-hidden hover:-translate-y-1 transition-transform duration-300">
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-blue-50 rounded-full blur-2xl opacity-60"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full border border-gray-100">Total</span>
            </div>
            <p class="text-sm font-semibold text-gray-500 mb-1">Produk Ditemukan</p>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $analysis['total_products'] }}</h3>
            <p class="text-xs text-gray-400 mt-2"><span class="text-green-500 font-bold">{{ $analysis['total_active'] }}</span> Aktif</p>
        </div>
    </div>

    <div class="relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 overflow-hidden hover:-translate-y-1 transition-transform duration-300">
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-50 rounded-full blur-2xl opacity-60"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full border border-gray-100">Views</span>
            </div>
            <p class="text-sm font-semibold text-gray-500 mb-1">Total Dilihat</p>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ number_format($analysis['total_views'], 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">Akumulasi views</p>
        </div>
    </div>

    <div class="relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 overflow-hidden hover:-translate-y-1 transition-transform duration-300">
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-amber-50 rounded-full blur-2xl opacity-60"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full border border-gray-100">Average</span>
            </div>
            <p class="text-sm font-semibold text-gray-500 mb-1">Rata-rata Harga</p>
            <h3 class="text-2xl font-extrabold text-gray-900 truncate">Rp{{ number_format($analysis['avg_price'], 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">Dari data tersaring</p>
        </div>
    </div>

    <div class="relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 overflow-hidden hover:-translate-y-1 transition-transform duration-300">
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-red-50 rounded-full blur-2xl opacity-60"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <span class="text-xs font-bold text-red-500 bg-red-50 px-2.5 py-1 rounded-full border border-red-100">Peringatan</span>
            </div>
            <p class="text-sm font-semibold text-gray-500 mb-1">Stok Menipis (< 10)</p>
            <h3 class="text-3xl font-extrabold text-red-600">{{ $analysis['low_stock'] }} <span class="text-lg text-red-400 font-medium">Item</span></h3>
            <p class="text-xs text-gray-400 mt-2">Perlu di-*restock*</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-4 gap-8 mb-8">
    
    <!-- Chart: Distribusi Kategori -->
    <div class="xl:col-span-1 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Distribusi Kategori</h3>
            <p class="text-xs text-gray-500 mt-1">Komposisi produk tersaring.</p>
        </div>
        <div class="p-6 flex-1 flex items-center justify-center relative min-h-[250px]">
            @if(count($chartData) > 0)
                <canvas id="categoryChart"></canvas>
            @else
                <p class="text-gray-400 text-sm text-center">Tidak ada data untuk grafik.</p>
            @endif
        </div>
    </div>

    <!-- Top Products -->
    <div class="xl:col-span-1 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Produk Populer</h3>
            <p class="text-xs text-gray-500 mt-1">Berdasarkan tayangan produk.</p>
        </div>
        <div class="p-0">
            <ul class="divide-y divide-gray-50">
                @forelse($analysis['top_products'] as $top)
                <li class="p-4 hover:bg-gray-50 transition-colors flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0">
                        @if($top->hasMedia('products'))
                            <img src="{{ $top->getFirstMediaUrl('products') }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-900 truncate">{{ $top->name }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $top->category->name ?? '-' }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="inline-flex items-center text-xs font-bold bg-blue-50 text-blue-600 px-2 py-1 rounded-lg">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ number_format($top->views ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                </li>
                @empty
                <li class="p-6 text-center text-gray-500 text-sm">Belum ada data.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Data Table -->
    <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Data Produk Tersaring</h3>
                <p class="text-xs text-gray-500 mt-1">Pratinjau data yang akan diekspor.</p>
            </div>
        </div>
        <div class="overflow-x-auto flex-1 max-h-[400px]">
            <table class="min-w-full divide-y divide-gray-100 relative">
                <thead class="bg-gray-50/80 sticky top-0 backdrop-blur-md">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Stok</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Dilihat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                            <div class="text-xs text-gray-500">{{ $product->sku ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-right text-sm">
                            <span class="{{ $product->stock < 10 ? 'text-red-600 font-bold' : 'text-gray-900' }}">{{ $product->stock }}</span>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-right text-sm text-gray-900 font-medium">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-center text-sm text-gray-500">
                            {{ $product->views ?? 0 }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 text-sm">Tidak ada produk yang cocok dengan filter.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(count($chartData) > 0)
        const ctx = document.getElementById('categoryChart').getContext('2d');
        
        // Prepare data from PHP
        const rawData = @json($chartData);
        const labels = Object.keys(rawData);
        const dataValues = Object.values(rawData);
        
        // Generate nice colors
        const bgColors = [
            'rgba(59, 130, 246, 0.8)', // blue
            'rgba(16, 185, 129, 0.8)', // emerald
            'rgba(245, 158, 11, 0.8)', // amber
            'rgba(239, 68, 68, 0.8)',  // red
            'rgba(139, 92, 246, 0.8)', // violet
            'rgba(236, 72, 153, 0.8)', // pink
            'rgba(14, 165, 233, 0.8)'  // sky
        ];

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { family: "'Inter', sans-serif", size: 11 },
                            usePointStyle: true,
                            padding: 15
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: { family: "'Inter', sans-serif" },
                        bodyFont: { family: "'Inter', sans-serif" },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                cutout: '70%'
            }
        });
        @endif
    });
</script>
@endpush
