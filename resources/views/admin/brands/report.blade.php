@extends('layouts.admin')

@section('title', 'Laporan Analitik Merek')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Laporan Performa Merek 📊</h2>
        <p class="text-gray-500 mt-1 text-sm">Wawasan mendalam mengenai sebaran produk dan total kunjungan per merek.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.brands.export.excel') }}" class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-semibold rounded-xl transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Excel
        </a>
        <a href="{{ route('admin.brands.export.pdf') }}" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-700 hover:bg-red-100 font-semibold rounded-xl transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            PDF
        </a>
    </div>
</div>

<!-- Key Metrics Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-6 -top-6 opacity-20">
            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-indigo-100 font-medium mb-1">Total Merek Terdaftar</p>
            <h3 class="text-4xl font-extrabold">{{ $brands->count() }}</h3>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-6 -top-6 opacity-20">
            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-emerald-100 font-medium mb-1">Total Keseluruhan Kunjungan</p>
            <h3 class="text-4xl font-extrabold">{{ number_format($brands->sum('products_sum_views')) }}</h3>
        </div>
    </div>

    <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-6 -top-6 opacity-20">
            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-amber-100 font-medium mb-1">Status Merek Aktif</p>
            <h3 class="text-4xl font-extrabold">{{ $activeCount }} <span class="text-lg font-medium text-amber-200">/ {{ $brands->count() }}</span></h3>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    
    <!-- Bar Chart: Products per Brand -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
        <div class="mb-4">
            <h3 class="text-lg font-bold text-gray-900">Distribusi Produk per Merek</h3>
            <p class="text-sm text-gray-500">Jumlah produk yang terdaftar untuk masing-masing merek.</p>
        </div>
        <div class="relative h-64 w-full">
            <canvas id="productsChart"></canvas>
        </div>
    </div>

    <!-- Doughnut Chart: Views per Brand -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
        <div class="mb-4">
            <h3 class="text-lg font-bold text-gray-900">Popularitas Merek (Kunjungan)</h3>
            <p class="text-sm text-gray-500">Merek mana yang produknya paling banyak dilihat pengunjung.</p>
        </div>
        <div class="relative h-64 w-full flex justify-center">
            <canvas id="viewsChart"></canvas>
        </div>
    </div>

</div>

<!-- Data Table Section -->
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-lg font-bold text-gray-900">Tabel Rincian Data Merek</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-white">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Merek</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Produk</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Kunjungan</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Rata-rata/Produk</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Produk Terpopuler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($brands as $index => $brand)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($brand->getFirstMediaUrl('brands'))
                                <img class="h-8 w-8 rounded-lg object-cover bg-gray-100 p-1 mr-3 border border-gray-200" src="{{ $brand->getFirstMediaUrl('brands', 'thumb') ?: $brand->getFirstMediaUrl('brands') }}" alt="">
                            @else
                                <div class="h-8 w-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-xs mr-3 border border-primary-200">
                                    {{ substr($brand->name, 0, 2) }}
                                </div>
                            @endif
                            <div class="text-sm font-bold text-gray-900">{{ $brand->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($brand->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium {{ $brand->products_count > 0 ? 'text-indigo-600' : 'text-gray-400' }}">
                        {{ $brand->products_count }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium {{ $brand->products_sum_views > 0 ? 'text-emerald-600' : 'text-gray-400' }}">
                        {{ number_format($brand->products_sum_views ?? 0) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">
                        {{ $brand->products_count > 0 ? number_format(($brand->products_sum_views ?? 0) / $brand->products_count, 1) : 0 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($brand->topProduct)
                            <div class="font-medium text-gray-900 truncate max-w-[200px]" title="{{ $brand->topProduct->name }}">{{ $brand->topProduct->name }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ number_format($brand->topProduct->views) }} views</div>
                        @else
                            <span class="text-gray-400 italic">Belum ada data</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada data merek.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $brands->links() }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const brandNames = {!! json_encode($brands->pluck('name')) !!};
    const productCounts = {!! json_encode($brands->pluck('products_count')) !!};
    const productViews = {!! json_encode($brands->pluck('products_sum_views')->map(function($view) { return $view ?? 0; })) !!};

    // Product Count Bar Chart
    const ctxProducts = document.getElementById('productsChart').getContext('2d');
    new Chart(ctxProducts, {
        type: 'bar',
        data: {
            labels: brandNames,
            datasets: [{
                label: 'Jumlah Produk',
                data: productCounts,
                backgroundColor: 'rgba(99, 102, 241, 0.8)', // Indigo-500
                borderColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });

    // Views Doughnut Chart
    const ctxViews = document.getElementById('viewsChart').getContext('2d');
    
    // Generate distinct colors
    const colors = [
        '#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316'
    ];
    const bgColors = brandNames.map((_, i) => colors[i % colors.length]);

    new Chart(ctxViews, {
        type: 'doughnut',
        data: {
            labels: brandNames,
            datasets: [{
                data: productViews,
                backgroundColor: bgColors,
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' }
            },
            cutout: '70%'
        }
    });
});
</script>
@endpush
