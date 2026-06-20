@extends('layouts.admin')

@section('title', 'Data Pengunjung')
@section('header', 'Data Pengunjung')

@section('content')
<div class="mb-8 flex flex-col xl:flex-row justify-between items-start xl:items-center gap-6">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Analitik Pengunjung</h2>
        <p class="text-gray-500 text-sm mt-1">Pantau lalu lintas dan aktivitas pengunjung website Anda secara detail.</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center w-full xl:w-auto">
        <form method="GET" action="{{ route('admin.visitors.index') }}" class="flex flex-wrap sm:flex-nowrap items-center gap-3 bg-white p-2.5 rounded-2xl shadow-sm border border-gray-100 w-full sm:w-auto">
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <input type="date" name="start_date" value="{{ request('start_date', $startDate) }}" class="rounded-xl border-gray-200 bg-gray-50 shadow-sm text-sm w-full sm:w-36 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                <span class="text-gray-400 text-sm font-medium">s/d</span>
                <input type="date" name="end_date" value="{{ request('end_date', $endDate) }}" class="rounded-xl border-gray-200 bg-gray-50 shadow-sm text-sm w-full sm:w-36 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
            </div>
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-primary-700 transition-colors w-full sm:w-auto flex justify-center shadow-sm">
                Filter
            </button>
        </form>

        <div class="flex gap-3 w-full sm:w-auto">
            <a href="{{ route('admin.visitors.export.excel', ['start_date' => request('start_date', $startDate), 'end_date' => request('end_date', $endDate)]) }}" onclick="const url = new URL(this.href); url.searchParams.set('tz', Intl.DateTimeFormat().resolvedOptions().timeZone); this.href = url.toString();" target="_blank" class="flex-1 sm:flex-none inline-flex justify-center items-center gap-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-2.5 px-4 rounded-xl transition-all text-sm shadow-lg shadow-green-500/30 transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Excel
            </a>
            <a href="{{ route('admin.visitors.export.pdf', ['start_date' => request('start_date', $startDate), 'end_date' => request('end_date', $endDate)]) }}" onclick="const url = new URL(this.href); url.searchParams.set('tz', Intl.DateTimeFormat().resolvedOptions().timeZone); this.href = url.toString();" target="_blank" class="flex-1 sm:flex-none inline-flex justify-center items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-2.5 px-4 rounded-xl transition-all text-sm shadow-lg shadow-red-500/30 transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                PDF
            </a>
        </div>
    </div>
</div>

@if(session('success'))
<div class="mb-6 bg-green-50 text-green-700 p-4 rounded-2xl border border-green-100 flex items-center gap-3">
    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </div>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    
    <!-- Main Line Chart -->
    <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-6 opacity-5 pointer-events-none">
            <svg class="w-32 h-32 text-primary-500" fill="currentColor" viewBox="0 0 24 24"><path d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
        </div>
        <div class="flex justify-between items-center mb-6 relative z-10">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                </div>
                Statistik Kunjungan
            </h3>
        </div>
        <div class="relative h-80 w-full z-10">
            <canvas id="mainVisitorChart"></canvas>
        </div>
    </div>

    <!-- Browser Pie Chart -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 relative overflow-hidden">
        <div class="flex justify-between items-center mb-6 relative z-10">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                </div>
                Peramban (Browser)
            </h3>
        </div>
        <div class="relative h-64 w-full flex justify-center z-10">
            <canvas id="browserChart"></canvas>
        </div>
    </div>

</div>

<!-- Additional Charts Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    
    <!-- Day of Week Bar Chart -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 relative overflow-hidden">
        <div class="flex justify-between items-center mb-6 relative z-10">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                Kunjungan Berdasarkan Hari
            </h3>
        </div>
        <div class="relative h-64 w-full z-10">
            <canvas id="dayChart"></canvas>
        </div>
    </div>

    <!-- Device Type Chart -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 relative overflow-hidden">
        <div class="flex justify-between items-center mb-6 relative z-10">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                Perangkat (Device)
            </h3>
        </div>
        <div class="relative h-64 w-full flex justify-center z-10">
            <canvas id="deviceChart"></canvas>
        </div>
    </div>

</div>

<!-- Top Pages and Locations -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    
    <!-- Top Pages Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Halaman Terpopuler
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-50">
                <thead class="bg-white">
                    <tr>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">URL Halaman</th>
                        <th class="px-6 sm:px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Views</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-50">
                    @forelse($topPages as $page)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="px-6 sm:px-8 py-4 text-sm font-medium text-gray-700 truncate max-w-[200px]" title="{{ $page->url }}">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                <span class="truncate">/{{ $page->url }}</span>
                            </div>
                        </td>
                        <td class="px-6 sm:px-8 py-4 text-sm font-bold text-gray-900 text-right">{{ number_format($page->total_hits) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="px-6 sm:px-8 py-8 text-center text-sm text-gray-500">Belum ada data halaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $topPages->links() }}
        </div>
    </div>

    <!-- Top Locations Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Lokasi Teratas
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-50">
                <thead class="bg-white">
                    <tr>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kota / Negara</th>
                        <th class="px-6 sm:px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Pengunjung</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-50">
                    @forelse($topLocations as $loc)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="px-6 sm:px-8 py-4 text-sm font-medium text-gray-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $loc->city }}, {{ $loc->country }}
                            </div>
                        </td>
                        <td class="px-6 sm:px-8 py-4 text-sm font-bold text-gray-900 text-right">{{ number_format($loc->visitors) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="px-6 sm:px-8 py-8 text-center text-sm text-gray-500">Belum ada data lokasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50/50 overflow-x-auto">
            {{ $topLocations->links() }}
        </div>
    </div>

</div>

<!-- Table Section -->
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            Log Kunjungan Terbaru
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-50">
            <thead class="bg-white">
                <tr>
                    <th scope="col" class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">IP Address</th>
                    <th scope="col" class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Page Views</th>
                    <th scope="col" class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lokasi / Browser</th>
                    <th scope="col" class="px-6 sm:px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Tindakan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($visitors as $visitor)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($visitor->visit_date)->translatedFormat('d M Y') }}</div>
                        <div class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $visitor->updated_at->format('H:i') }}
                        </div>
                    </td>
                    <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold bg-gray-100 text-gray-800 font-mono border border-gray-200">
                            {{ $visitor->ip_address }}
                        </span>
                        @if(in_array($visitor->ip_address, $blockedIps))
                            <span class="ml-2 inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-red-100 text-red-800 border border-red-200 shadow-sm">
                                Diblokir
                            </span>
                        @endif
                    </td>
                    <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                        <div class="inline-flex items-center justify-center min-w-[3rem] px-3 py-1 rounded-full bg-primary-50 text-primary-700 text-sm font-bold border border-primary-100">
                            {{ $visitor->hits }}
                        </div>
                    </td>
                    <td class="px-6 sm:px-8 py-5">
                        @if($visitor->city)
                        <div class="text-sm font-bold text-gray-900 mb-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $visitor->city }}, {{ $visitor->country }}
                        </div>
                        @endif
                        <div class="text-xs text-gray-500 truncate max-w-xs flex items-center gap-1.5" title="{{ $visitor->user_agent }}">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            <span class="truncate">{{ Str::limit($visitor->user_agent ?? 'Unknown', 40) }}</span>
                        </div>
                    </td>
                    <td class="px-6 sm:px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                        @if(in_array($visitor->ip_address, $blockedIps))
                            <form method="POST" action="{{ route('admin.visitors.unblock', $visitor->ip_address) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-gray-100 text-gray-700 px-4 py-2 rounded-xl font-bold hover:bg-gray-200 transition-colors shadow-sm">Buka Blokir</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.visitors.block') }}" class="inline">
                                @csrf
                                <input type="hidden" name="ip_address" value="{{ $visitor->ip_address }}">
                                <button type="submit" class="text-xs bg-red-50 text-red-600 border border-red-200 px-4 py-2 rounded-xl font-bold hover:bg-red-100 hover:text-red-700 transition-colors shadow-sm" onclick="return confirm('Blokir akses untuk IP {{ $visitor->ip_address }}?')">Blokir IP</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 sm:px-8 py-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada pengunjung</h3>
                        <p class="text-gray-500 text-sm">Data log kunjungan akan muncul di sini.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $visitors->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('mainVisitorChart').getContext('2d');
        
        const labels = {!! json_encode($chartData['labels'] ?? []) !!};
        const uniqueVisitors = {!! json_encode($chartData['unique_visitors'] ?? []) !!};
        const pageViews = {!! json_encode($chartData['page_views'] ?? []) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Kunjungan (Page Views)',
                        data: pageViews,
                        borderColor: '#06b6d4', // Cyan-500
                        backgroundColor: 'rgba(6, 182, 212, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#06b6d4',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Pengunjung Unik (IP)',
                        data: uniqueVisitors,
                        borderColor: '#3b82f6', // Blue-500
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        fill: false,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { usePointStyle: true, padding: 20, font: { family: "'Inter', sans-serif", size: 13 } }
                    },
                    tooltip: {
                        mode: 'index', intersect: false, backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: { family: "'Inter', sans-serif", size: 13 },
                        bodyFont: { family: "'Inter', sans-serif", size: 13 },
                        padding: 12, cornerRadius: 8
                    }
                },
                interaction: { mode: 'nearest', axis: 'x', intersect: false },
                scales: {
                    x: { grid: { display: false, drawBorder: false }, ticks: { font: { family: "'Inter', sans-serif" } } },
                    y: { beginAtZero: true, grid: { borderDash: [4, 4], color: '#f3f4f6', drawBorder: false }, ticks: { stepSize: 1, font: { family: "'Inter', sans-serif" } } }
                }
            }
        });

        // Browser Pie Chart
        const browserCtx = document.getElementById('browserChart').getContext('2d');
        const browserLabels = {!! json_encode($browserChartData['labels'] ?? []) !!};
        const browserData = {!! json_encode($browserChartData['data'] ?? []) !!};

        new Chart(browserCtx, {
            type: 'doughnut',
            data: {
                labels: browserLabels,
                datasets: [{
                    data: browserData,
                    backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#06b6d4', '#ef4444', '#6b7280'],
                    borderWidth: 0, hoverOffset: 4
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { family: "'Inter', sans-serif", size: 12 } } },
                    tooltip: { backgroundColor: 'rgba(17, 24, 39, 0.9)', titleFont: { family: "'Inter', sans-serif" }, bodyFont: { family: "'Inter', sans-serif" }, padding: 12, cornerRadius: 8 }
                }
            }
        });

        // Device Type Pie Chart
        const deviceCtx = document.getElementById('deviceChart').getContext('2d');
        const deviceLabels = {!! json_encode($deviceChartData['labels'] ?? []) !!};
        const deviceData = {!! json_encode($deviceChartData['data'] ?? []) !!};

        new Chart(deviceCtx, {
            type: 'doughnut',
            data: {
                labels: deviceLabels,
                datasets: [{
                    data: deviceData,
                    backgroundColor: ['#8b5cf6', '#ec4899', '#14b8a6'],
                    borderWidth: 0, hoverOffset: 4
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { family: "'Inter', sans-serif", size: 12 } } },
                    tooltip: { backgroundColor: 'rgba(17, 24, 39, 0.9)', titleFont: { family: "'Inter', sans-serif" }, bodyFont: { family: "'Inter', sans-serif" }, padding: 12, cornerRadius: 8 }
                }
            }
        });

        // Day of Week Bar Chart
        const dayCtx = document.getElementById('dayChart').getContext('2d');
        const dayLabels = {!! json_encode($dayChartData['labels'] ?? []) !!};
        const dayData = {!! json_encode($dayChartData['data'] ?? []) !!};

        new Chart(dayCtx, {
            type: 'bar',
            data: {
                labels: dayLabels,
                datasets: [{
                    label: 'Total Kunjungan per Hari', data: dayData,
                    backgroundColor: 'rgba(139, 92, 246, 0.8)', borderColor: '#8b5cf6', borderWidth: 1, borderRadius: 6
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { backgroundColor: 'rgba(17, 24, 39, 0.9)', titleFont: { family: "'Inter', sans-serif" }, bodyFont: { family: "'Inter', sans-serif" }, padding: 12, cornerRadius: 8 }
                },
                scales: {
                    x: { grid: { display: false, drawBorder: false }, ticks: { font: { family: "'Inter', sans-serif" } } },
                    y: { beginAtZero: true, grid: { borderDash: [4, 4], color: '#f3f4f6', drawBorder: false }, ticks: { stepSize: 1, font: { family: "'Inter', sans-serif" } } }
                }
            }
        });
    });
</script>
@endpush
