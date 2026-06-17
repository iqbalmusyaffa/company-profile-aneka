@extends('layouts.app')

@section('title', 'Kabar & Artikel - ' . ($settings['store_name'] ?? 'Toko Bangunan Aneka Jaya'))

@section('content')
<!-- Hero -->
<div class="bg-primary-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6">Kabar & Panduan</h1>
        <p class="text-primary-100 text-lg max-w-2xl mx-auto">Temukan berbagai tips seputar bahan bangunan, panduan konstruksi, dan berita terbaru dari toko kami.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col lg:flex-row gap-10">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            @if(request('search'))
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900">Hasil Pencarian: "{{ request('search') }}"</h2>
                </div>
            @endif

            @if($posts->count() > 0)
                <div class="space-y-8">
                    @foreach($posts as $post)
                    <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row group hover:shadow-lg transition-all duration-300">
                        <div class="md:w-2/5 aspect-video md:aspect-auto relative overflow-hidden bg-gray-100 block shrink-0">
                            @if($post->hasMedia('posts'))
                                <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-primary-700 shadow-sm">
                                {{ $post->category->name ?? 'Berita' }}
                            </div>
                        </div>
                        <div class="p-6 md:w-3/5 flex flex-col">
                            <div class="text-sm text-gray-500 mb-2 flex items-center gap-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $post->created_at->format('d M Y') }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $post->author->name ?? 'Admin' }}
                                </span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug ?? $post->id) }}" class="block">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <p class="text-gray-600 line-clamp-3 mb-4 text-sm leading-relaxed">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 150) }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('blog.show', $post->slug ?? $post->id) }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-800 transition-colors">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada artikel</h3>
                    <p class="text-gray-500">Kami belum mempublikasikan artikel yang sesuai dengan pencarian Anda.</p>
                    @if(request('search'))
                        <a href="{{ route('blog.index') }}" class="mt-6 text-primary-600 hover:text-primary-800 font-medium">Lihat Semua Artikel</a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Search -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Cari Artikel</h3>
                <form action="{{ route('blog.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-primary-500 focus:border-primary-500" placeholder="Ketik kata kunci...">
                        <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400 hover:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Topik Tersedia</h3>
                <ul class="space-y-3">
                    @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('product.index', ['search' => $cat->name]) }}" class="flex items-center justify-between group">
                            <span class="text-gray-600 group-hover:text-primary-600 transition-colors">{{ $cat->name }}</span>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Banner Ads (Optional) -->
            <div class="bg-primary-900 rounded-2xl p-6 text-center text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-20"><svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-2">Butuh Material Bangunan?</h3>
                    <p class="text-primary-200 text-sm mb-6">Konsultasikan kebutuhan Anda bersama tim ahli kami.</p>
                    @php $phoneRaw = preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+6281234567890'); @endphp
                    <a href="https://wa.me/{{ ltrim($phoneRaw, '+') }}" target="_blank" class="block w-full bg-accent hover:bg-accent-hover text-white font-bold py-3 rounded-xl transition-colors shadow-lg">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
