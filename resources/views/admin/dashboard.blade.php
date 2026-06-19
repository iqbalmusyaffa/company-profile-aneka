@extends('layouts.admin')

@section('title', 'Dasbor Utama')
@section('header', 'Dasbor Utama')

@section('content')
<!-- Header Greeting -->
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}! 👋</h2>
        <p class="text-gray-500 mt-1 text-sm">Berikut adalah ringkasan performa toko dan website Anda hari ini.</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="bg-primary-50 text-primary-700 px-4 py-2 rounded-lg text-sm font-semibold border border-primary-100 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
    
    <!-- Total Products Card -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600 rounded-3xl shadow-lg shadow-blue-500/30 p-6 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group border border-white/10">
        <div class="absolute -right-6 -top-6 opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
            <svg class="w-32 h-32 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="flex items-center justify-between mb-4">
                <p class="text-blue-50 font-medium text-sm tracking-wide bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full border border-white/10">Total Produk</p>
            </div>
            <div>
                <h3 class="text-5xl font-extrabold text-white tracking-tight drop-shadow-sm">{{ $stats['total_products'] }}</h3>
                <div class="mt-3 flex items-center text-blue-100 text-sm font-medium">
                    <span class="flex items-center bg-green-400/20 text-green-300 px-2 py-0.5 rounded-full mr-2 text-xs backdrop-blur-sm border border-green-400/20">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        +12%
                    </span>
                    Bulan ini
                </div>
            </div>
        </div>
    </div>

    <!-- Total Categories Card -->
    <div class="relative bg-gradient-to-br from-amber-500 via-orange-400 to-pink-500 rounded-3xl shadow-lg shadow-orange-500/30 p-6 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group border border-white/10">
        <div class="absolute -right-6 -top-6 opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
            <svg class="w-32 h-32 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="flex items-center justify-between mb-4">
                <p class="text-orange-50 font-medium text-sm tracking-wide bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full border border-white/10">Kategori</p>
            </div>
            <div>
                <h3 class="text-5xl font-extrabold text-white tracking-tight drop-shadow-sm">{{ $stats['total_categories'] }}</h3>
                <div class="mt-3 flex items-center text-orange-100 text-sm font-medium">
                    Aktif & Digunakan
                </div>
            </div>
        </div>
    </div>

    <!-- Total Brands Card -->
    <div class="relative bg-gradient-to-br from-violet-600 via-purple-500 to-fuchsia-500 rounded-3xl shadow-lg shadow-purple-500/30 p-6 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group border border-white/10">
        <div class="absolute -right-6 -top-6 opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
            <svg class="w-32 h-32 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="flex items-center justify-between mb-4">
                <p class="text-purple-50 font-medium text-sm tracking-wide bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full border border-white/10">Merek Mitra</p>
            </div>
            <div>
                <h3 class="text-5xl font-extrabold text-white tracking-tight drop-shadow-sm">{{ $stats['total_brands'] }}</h3>
                <div class="mt-3 flex items-center text-purple-100 text-sm font-medium">
                    Supplier Terdaftar
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Posts Card -->
    <div class="relative bg-gradient-to-br from-emerald-500 via-teal-400 to-cyan-500 rounded-3xl shadow-lg shadow-emerald-500/30 p-6 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group border border-white/10">
        <div class="absolute -right-6 -top-6 opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
            <svg class="w-32 h-32 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="flex items-center justify-between mb-4">
                <p class="text-emerald-50 font-medium text-sm tracking-wide bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full border border-white/10">Artikel Blog</p>
            </div>
            <div>
                <h3 class="text-5xl font-extrabold text-white tracking-tight drop-shadow-sm">{{ $stats['total_posts'] }}</h3>
                <div class="mt-3 flex items-center text-emerald-100 text-sm font-medium">
                    Telah Dipublikasikan
                </div>
            </div>
        </div>
    </div>

    <!-- Visitors Card -->
    <div class="relative bg-gradient-to-br from-rose-500 via-red-400 to-orange-500 rounded-3xl shadow-lg shadow-red-500/30 p-6 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group border border-white/10">
        <div class="absolute -right-6 -top-6 opacity-20 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
            <svg class="w-32 h-32 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="flex items-center justify-between mb-4">
                <p class="text-rose-50 font-medium text-sm tracking-wide bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full border border-white/10">Total Pengunjung</p>
            </div>
            <div>
                <h3 class="text-5xl font-extrabold text-white tracking-tight drop-shadow-sm">{{ $stats['total_visitors'] }}</h3>
                <div class="mt-3 flex items-center text-rose-100 text-sm font-medium">
                    <span class="flex items-center bg-white/20 text-white px-2 py-0.5 rounded-full mr-2 text-xs backdrop-blur-sm border border-white/20 font-bold">
                        {{ $stats['today_visitors'] }}
                    </span>
                    Hari ini
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    
    <!-- Chart Section -->
    <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 p-6 lg:p-8 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        Statistik Pengunjung
                    </h3>
                    <p class="text-gray-500 text-sm mt-1">Lalu lintas website Anda dalam 30 hari terakhir</p>
                </div>
                <a href="{{ route('admin.visitors.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 bg-primary-50 hover:bg-primary-100 px-4 py-2 rounded-xl transition-colors flex items-center">
                    Detail <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
            <div class="relative h-80 w-full">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions / Mini Summary -->
    <div class="flex flex-col gap-6">
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-8 text-white shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl transform translate-x-10 -translate-y-10"></div>
            <div class="absolute left-0 bottom-0 w-24 h-24 bg-primary-500 opacity-20 rounded-full blur-xl transform -translate-x-10 translate-y-10"></div>
            
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-2">Pintasan Cepat</h3>
                <p class="text-gray-400 text-sm mb-6">Akses menu yang sering digunakan dengan cepat.</p>
                
                <div class="flex flex-col gap-3">
                    <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-4 py-3 rounded-xl transition-all border border-white/5 group">
                        <div class="bg-white/10 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <span class="font-medium text-sm">Tambah Produk Baru</span>
                    </a>
                    <a href="{{ route('admin.posts.create') }}" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-4 py-3 rounded-xl transition-all border border-white/5 group">
                        <div class="bg-white/10 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <span class="font-medium text-sm">Tulis Artikel Baru</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-4 py-3 rounded-xl transition-all border border-white/5 group">
                        <div class="bg-white/10 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <span class="font-medium text-sm">Pengaturan Website</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Products Section -->
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                Produk Terbaru
            </h3>
            <p class="text-gray-500 text-sm mt-1">Produk yang baru saja ditambahkan ke dalam katalog.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 bg-primary-50 hover:bg-primary-100 px-5 py-2.5 rounded-xl transition-colors">Lihat Semua</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/50">
                <tr>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Info Produk</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori / Merek</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse(\App\Models\Product::with(['category', 'brand'])->latest()->take(5)->get() as $product)
                <tr class="hover:bg-gray-50/80 transition-colors group">
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-14 w-14 flex-shrink-0">
                                @if($product->hasMedia('products'))
                                    <img class="h-14 w-14 rounded-xl object-cover border border-gray-200 shadow-sm" src="{{ $product->getFirstMediaUrl('products') }}" alt="">
                                @else
                                    <div class="h-14 w-14 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-gray-900 group-hover:text-primary-600 transition-colors">{{ $product->name }}</div>
                                <div class="text-xs text-gray-500 mt-1 font-mono">SKU: {{ $product->sku ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 font-medium">{{ $product->category->name ?? 'Tanpa Kategori' }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $product->brand->name ?? 'Tanpa Merek' }}</div>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-primary-700">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        @if($product->is_active)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                Aktif
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                Draft
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-10 text-center text-gray-500">
                        Belum ada produk terbaru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('visitorChart').getContext('2d');
        
        const labels = {!! json_encode($chartData['labels'] ?? []) !!};
        const uniqueVisitors = {!! json_encode($chartData['unique_visitors'] ?? []) !!};
        const pageViews = {!! json_encode($chartData['page_views'] ?? []) !!};

        // Create gradient for line chart
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.4)'); // Blue-500
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Kunjungan (Page Views)',
                        data: pageViews,
                        borderColor: '#3b82f6', // Blue-500
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4,
                        cubicInterpolationMode: 'monotone'
                    },
                    {
                        label: 'Pengunjung Unik',
                        data: uniqueVisitors,
                        borderColor: '#8b5cf6', // Violet-500
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#8b5cf6',
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        fill: false,
                        tension: 0.4,
                        cubicInterpolationMode: 'monotone'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { family: "'Inter', sans-serif", size: 13, weight: '500' }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#111827',
                        bodyColor: '#4b5563',
                        borderColor: 'rgba(0,0,0,0.05)',
                        borderWidth: 1,
                        titleFont: { family: "'Inter', sans-serif", size: 13, weight: 'bold' },
                        bodyFont: { family: "'Inter', sans-serif", size: 13, weight: '500' },
                        padding: 14,
                        cornerRadius: 12,
                        boxPadding: 8,
                        usePointStyle: true,
                        boxWidth: 8,
                        boxHeight: 8,
                        boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)'
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { font: { family: "'Inter', sans-serif", color: '#6b7280' } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6', drawBorder: false, borderDash: [5, 5] },
                        ticks: { stepSize: 1, font: { family: "'Inter', sans-serif", color: '#6b7280' }, padding: 10 }
                    }
                }
            }
        });
    });
</script>
@endpush
