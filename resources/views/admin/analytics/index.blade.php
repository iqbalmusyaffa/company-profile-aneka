@extends('layouts.admin')

@section('title', 'Analitik Lanjutan')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Analitik & Wawasan Lanjutan 📈</h2>
    <p class="text-gray-500 mt-1 text-sm">Pantau performa website, asal pengunjung, dan status SEO Anda secara mendalam.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    
    <!-- Total Visitors -->
    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="bg-primary-50 p-4 rounded-2xl text-primary-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Total Pengunjung Unik</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ number_format($totalVisitors) }}</h3>
        </div>
    </div>

    <!-- Mobile Users -->
    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="bg-blue-50 p-4 rounded-2xl text-blue-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Pengguna Mobile</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ number_format($mobileVisitors) }}</h3>
            @if($totalVisitors > 0)
                <p class="text-xs text-green-500 font-medium">{{ round(($mobileVisitors / $totalVisitors) * 100) }}% dari total pengunjung</p>
            @endif
        </div>
    </div>

    <!-- SEO Alerts -->
    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="bg-rose-50 p-4 rounded-2xl text-rose-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Halaman Butuh Optimasi SEO</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ $seoPagesNeedsAttention->count() }} <span class="text-sm text-gray-400 font-normal">/ {{ $totalSeoPages }} halaman</span></h3>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    
    <!-- Top Pages -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Halaman Terpopuler</h3>
            <p class="text-sm text-gray-500">Berdasarkan total kunjungan (hits).</p>
        </div>
        <div class="p-0">
            <ul class="divide-y divide-gray-50">
                @forelse($topPages as $index => $page)
                <li class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold shrink-0">{{ $topPages->firstItem() + $index }}</span>
                        <div class="truncate">
                            <a href="{{ $page->url }}" target="_blank" class="text-sm font-medium text-primary-600 hover:text-primary-800 truncate block">{{ Str::limit($page->url, 40) }}</a>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 shrink-0">
                        {{ number_format($page->total_hits) }} views
                    </span>
                </li>
                @empty
                <li class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada data halaman yang dilihat.</li>
                @endforelse
            </ul>
        </div>
        @if($topPages->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $topPages->links() }}
        </div>
        @endif
    </div>

    <!-- Traffic Sources Location -->
    <div class="flex flex-col gap-8">
        <!-- Top Cities -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Asal Kota Pengunjung</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($topCities as $city)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700">{{ $city->city }}</span>
                            <span class="text-gray-500">{{ number_format($city->total_visitors) }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-primary-500 h-2 rounded-full" style="width: {{ $totalVisitors > 0 ? ($city->total_visitors / $totalVisitors) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 text-sm py-4">Data kota tidak tersedia.</div>
                    @endforelse
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 overflow-x-auto">
                {{ $topCities->links() }}
            </div>
        </div>

        <!-- Top Countries -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Asal Negara Pengunjung</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($topCountries as $country)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700">{{ $country->country }}</span>
                            <span class="text-gray-500">{{ number_format($country->total_visitors) }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ $totalVisitors > 0 ? ($country->total_visitors / $totalVisitors) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 text-sm py-4">Data negara tidak tersedia.</div>
                    @endforelse
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 overflow-x-auto">
                {{ $topCountries->links() }}
            </div>
        </div>
    </div>

</div>

<!-- SEO Improvement Suggestions -->
@if($seoPagesNeedsAttention->count() > 0)
<div class="bg-rose-50 border border-rose-100 rounded-3xl p-6 mb-8">
    <div class="flex items-start gap-4">
        <div class="bg-white p-3 rounded-full text-rose-500 shrink-0 shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-rose-900">Perhatian SEO</h3>
            <p class="text-sm text-rose-700 mt-1 mb-4">Ada beberapa halaman yang belum memiliki Meta Title atau Meta Description. Hal ini penting untuk performa mesin pencari Google.</p>
            
            <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-rose-100">
                <table class="min-w-full divide-y divide-rose-100">
                    <thead class="bg-rose-50/50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-rose-800 uppercase tracking-wider">URL</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-rose-800 uppercase tracking-wider">Masalah</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-bold text-rose-800 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-rose-100">
                        @foreach($seoPagesNeedsAttention->take(5) as $seoPage)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900 break-all">{{ $seoPage->url }}</td>
                            <td class="px-4 py-3 text-sm text-rose-600">
                                @if(!$seoPage->meta_title && !$seoPage->meta_description)
                                    Meta Title & Description Kosong
                                @elseif(!$seoPage->meta_title)
                                    Meta Title Kosong
                                @else
                                    Meta Description Kosong
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-right">
                                <a href="{{ route('admin.seo-pages.edit', $seoPage) }}" class="text-primary-600 hover:text-primary-800 font-medium text-sm bg-primary-50 px-3 py-1 rounded-lg">Perbaiki</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($seoPagesNeedsAttention->count() > 5)
            <div class="mt-3">
                <a href="{{ route('admin.seo-pages.index') }}" class="text-sm font-medium text-rose-700 hover:text-rose-900 underline">Lihat semua {{ $seoPagesNeedsAttention->count() }} halaman</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endif

@endsection
