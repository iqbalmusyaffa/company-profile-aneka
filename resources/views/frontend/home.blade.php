@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="relative bg-primary-950 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero.png') }}" alt="Toko Bangunan Aneka Jaya Interior" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-primary-900/80 to-transparent"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 flex flex-col items-center text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-accent/20 text-accent border border-accent/30 text-sm font-semibold mb-6 tracking-wide uppercase">{{ $settings['hero_subtitle'] ?? 'Toko Bangunan Terlengkap di Banyuwangi' }}</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-8 leading-tight max-w-4xl">
            {!! $settings['hero_title'] ?? 'Bangun <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-300">Rumah Impian Anda</span> dengan Material Berkualitas' !!}
        </h1>
        <p class="text-lg md:text-xl text-primary-200 mb-10 max-w-2xl font-light leading-relaxed">
            {{ $settings['hero_description'] ?? 'Menyediakan segala kebutuhan bahan bangunan dari fondasi hingga atap. Harga kompetitif, pelayanan ramah, dan kualitas terjamin.' }}
        </p>
        <div class="flex flex-col w-full max-w-3xl mx-auto gap-4">
            <!-- Search Bar -->
            <form action="{{ route('product.index') }}" method="GET" class="w-full relative shadow-2xl rounded-full overflow-hidden bg-white flex focus-within:ring-4 focus-within:ring-accent/30 transition-all">
                <div class="flex items-center pl-6 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" placeholder="Cari material bangunan (Cth: Semen, Pipa, Cat...)" class="w-full border-0 focus:ring-0 px-4 py-4 text-gray-900 text-lg rounded-full" required>
                <button type="submit" class="bg-accent hover:bg-accent-hover text-white px-8 py-4 font-bold text-lg transition-colors hidden sm:block">
                    Cari Produk
                </button>
            </form>

            <!-- Quick Links -->
            @if($categories->count() > 0)
            <div class="mt-6">
                <p class="text-primary-300 text-sm font-medium mb-3">Pencarian Populer:</p>
                <div class="flex flex-wrap justify-center gap-2 sm:gap-3">
                    @foreach($categories->take(5) as $category)
                        <a href="{{ route('category.show', $category->slug ?? $category->id) }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white rounded-full text-sm font-medium transition-colors">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Keunggulan Section -->
<div class="py-16 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Feature 1 -->
            <div class="flex flex-col items-center text-center p-6 rounded-2xl bg-primary-50/50 hover:bg-primary-50 transition-colors border border-transparent hover:border-primary-100">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-6 transform -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-primary-900 mb-3">Kualitas Terjamin</h3>
                <p class="text-gray-600 leading-relaxed">Semua material yang kami jual telah melewati standar SNI dan kontrol kualitas yang ketat.</p>
            </div>
            <!-- Feature 2 -->
            <div class="flex flex-col items-center text-center p-6 rounded-2xl bg-primary-50/50 hover:bg-primary-50 transition-colors border border-transparent hover:border-primary-100">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-6 transform rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-primary-900 mb-3">Pengiriman Cepat</h3>
                <p class="text-gray-600 leading-relaxed">Armada kami siap mengantarkan pesanan Anda ke seluruh pelosok Banyuwangi tepat waktu.</p>
            </div>
            <!-- Feature 3 -->
            <div class="flex flex-col items-center text-center p-6 rounded-2xl bg-primary-50/50 hover:bg-primary-50 transition-colors border border-transparent hover:border-primary-100">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-6 transform -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-primary-900 mb-3">Harga Kompetitif</h3>
                <p class="text-gray-600 leading-relaxed">Dapatkan harga terbaik untuk pembelian eceran maupun grosir proyek skala besar.</p>
            </div>
        </div>
    </div>
</div>

<!-- Kategori Populer -->
@if($categories->count() > 0)
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-primary-950 tracking-tight">Kategori Produk</h2>
                <div class="h-1.5 w-20 bg-accent mt-4 rounded-full"></div>
            </div>
            <a href="{{ route('product.index') }}" class="hidden sm:flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                Lihat Semua
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug ?? $category->id) }}" class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 aspect-square bg-primary-100 flex items-center justify-center">
                @if($category->hasMedia('categories'))
                    <img src="{{ $category->getFirstMediaUrl('categories') }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-950/90 via-primary-900/40 to-transparent"></div>
                @else
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-950/90 to-primary-800/80"></div>
                @endif
                <div class="absolute bottom-0 left-0 p-6 w-full">
                    <h3 class="text-white font-bold text-xl mb-1 group-hover:text-accent transition-colors truncate" title="{{ $category->name }}">{{ $category->name }}</h3>
                    <span class="text-primary-200 text-sm flex items-center opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                        Jelajahi <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Produk Unggulan -->
@if($featuredProducts->count() > 0)
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-primary-950 tracking-tight">Produk Unggulan</h2>
                <div class="h-1.5 w-20 bg-accent mt-4 rounded-full"></div>
            </div>
            <a href="{{ route('product.index') }}" class="hidden sm:flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                Katalog Lengkap
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
                <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="relative aspect-square overflow-hidden bg-gray-100 block">
                    @if($product->hasMedia('products'))
                        <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    @if($product->original_price > $product->price)
                        <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                            Diskon
                        </div>
                    @endif
                </a>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="text-xs text-primary-600 font-semibold mb-1">{{ $product->category->name ?? 'Uncategorized' }}</div>
                    <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="text-lg font-bold text-gray-900 mb-2 hover:text-primary-600 transition-colors line-clamp-2">
                        {{ $product->name }}
                    </a>
                    <div class="mt-auto">
                        @if($product->original_price > $product->price)
                            <div class="text-sm text-gray-400 line-through mb-0.5">Rp {{ number_format($product->original_price, 0, ',', '.') }}</div>
                        @endif
                        <div class="text-xl font-extrabold text-primary-700">
                            Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs font-normal text-gray-500">/{{ $product->unit }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Produk Terlaris / Trending Hari Ini -->
@if(isset($trendingProducts) && $trendingProducts->count() > 0)
<div class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wider flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                        Paling Banyak Dicari
                    </span>
                </div>
                <h2 class="text-3xl font-extrabold text-primary-950 tracking-tight">Trending Hari Ini</h2>
                <div class="h-1.5 w-20 bg-accent mt-4 rounded-full"></div>
            </div>
            <a href="{{ route('product.index', ['sort' => 'popular']) }}" class="hidden sm:flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                Lihat Semua
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($trendingProducts as $product)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group relative">
                <!-- Badge Hot -->
                <div class="absolute top-3 left-3 z-10 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-lg flex items-center">
                    🔥 HOT
                </div>
                
                <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="relative aspect-square overflow-hidden bg-gray-100 block">
                    @if($product->hasMedia('products'))
                        <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    @if($product->original_price > $product->price)
                        <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                            Diskon
                        </div>
                    @endif
                </a>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="text-xs text-primary-600 font-semibold mb-1">{{ $product->category->name ?? 'Uncategorized' }}</div>
                    <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="text-lg font-bold text-gray-900 mb-2 hover:text-primary-600 transition-colors line-clamp-2">
                        {{ $product->name }}
                    </a>
                    <div class="mt-auto">
                        @if($product->original_price > $product->price)
                            <div class="text-sm text-gray-400 line-through mb-0.5">Rp {{ number_format($product->original_price, 0, ',', '.') }}</div>
                        @endif
                        <div class="text-xl font-extrabold text-primary-700">
                            Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs font-normal text-gray-500">/{{ $product->unit }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Promo Banner -->
@if($promotions->count() > 0)
<div class="py-16 bg-primary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-primary-950 tracking-tight">Promo Menarik</h2>
                <div class="h-1.5 w-20 bg-accent mt-4 rounded-full"></div>
            </div>
            <a href="{{ route('promo') }}" class="hidden sm:flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                Lihat Semua Promo
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($promotions as $promo)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col sm:flex-row group hover:shadow-md transition-shadow relative">
                    <div class="sm:w-2/5 aspect-w-16 aspect-h-10 sm:aspect-none bg-gray-200">
                        @if($promo->hasMedia('promotions'))
                            <img src="{{ $promo->getFirstMediaUrl('promotions') }}" alt="{{ $promo->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 p-8">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 sm:w-3/5 flex flex-col justify-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $promo->title }}</h3>
                        
                        <div class="flex items-center space-x-2 mb-4 text-xs font-bold text-accent">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>
                                @if($promo->start_date && $promo->end_date)
                                    Sampai {{ $promo->end_date->format('d M Y') }}
                                @else
                                    Promo Terbatas
                                @endif
                            </span>
                        </div>

                        <a href="{{ route('promo') }}" class="mt-auto text-primary-600 hover:text-primary-800 font-semibold text-sm flex items-center">
                            Detail Promo
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Testimoni Pelanggan -->
@if(isset($testimonials) && $testimonials->count() > 0)
<div class="py-20 bg-primary-900 overflow-hidden relative">
    <div class="absolute inset-0 bg-[url('{{ asset('images/pattern.svg') }}')] opacity-10"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight mb-4">Apa Kata Pelanggan Kami</h2>
            <p class="text-primary-200 text-lg max-w-2xl mx-auto">Kepercayaan Anda adalah prioritas kami. Simak pengalaman mereka yang telah membangun impian bersama Aneka Jaya.</p>
        </div>
        
        <div class="flex overflow-x-auto pb-10 -mx-4 px-4 sm:mx-0 sm:px-0 gap-6 snap-x snap-mandatory [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none; -ms-overflow-style: none;">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-2xl p-8 shadow-xl relative mt-8 flex-none w-[85vw] sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] snap-center transition-all duration-300 hover:-translate-y-2 border border-transparent hover:border-primary-100 group">
                <!-- Quote Icon -->
                <div class="absolute -top-6 left-8 bg-accent text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                </div>
                
                <div class="flex text-yellow-400 mb-6 pt-2">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                </div>
                
                <p class="text-gray-700 italic mb-6 leading-relaxed">"{{ $testimonial->comment }}"</p>
                
                <div class="flex items-center gap-4 mt-auto">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 font-bold text-lg group-hover:bg-primary-600 group-hover:text-white transition-colors">
                        {{ substr($testimonial->customer_name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">{{ $testimonial->customer_name }}</h4>
                        <span class="text-sm text-gray-500">Pelanggan Setia</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Merek Mitra -->
@if($brands->count() > 0)
<div class="py-16 bg-gray-50 border-t border-b border-gray-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-400 uppercase tracking-widest text-sm">Mitra Brand Pilihan</h2>
        </div>
        <div class="relative flex overflow-hidden group py-4">
            <!-- First scrolling container -->
            <div class="flex animate-marquee group-hover:[animation-play-state:paused] whitespace-nowrap items-center">
                @foreach($brands as $brand)
                    <div class="mx-8 md:mx-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500 flex-shrink-0">
                        @if($brand->hasMedia('brands'))
                            <img src="{{ $brand->getFirstMediaUrl('brands') }}" alt="{{ $brand->name }}" class="h-12 md:h-16 w-auto object-contain hover:scale-110 transition-transform">
                        @else
                            <span class="text-xl font-extrabold text-gray-500">{{ $brand->name }}</span>
                        @endif
                    </div>
                @endforeach
                <!-- Duplicate 1 -->
                @foreach($brands as $brand)
                    <div class="mx-8 md:mx-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500 flex-shrink-0" aria-hidden="true">
                        @if($brand->hasMedia('brands'))
                            <img src="{{ $brand->getFirstMediaUrl('brands') }}" alt="{{ $brand->name }}" class="h-12 md:h-16 w-auto object-contain hover:scale-110 transition-transform">
                        @else
                            <span class="text-xl font-extrabold text-gray-500">{{ $brand->name }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <!-- Second scrolling container (Absolute) for seamless loop -->
            <div class="flex animate-marquee group-hover:[animation-play-state:paused] whitespace-nowrap items-center absolute top-0 py-4" aria-hidden="true">
                @foreach($brands as $brand)
                    <div class="mx-8 md:mx-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500 flex-shrink-0">
                        @if($brand->hasMedia('brands'))
                            <img src="{{ $brand->getFirstMediaUrl('brands') }}" alt="{{ $brand->name }}" class="h-12 md:h-16 w-auto object-contain hover:scale-110 transition-transform">
                        @else
                            <span class="text-xl font-extrabold text-gray-500">{{ $brand->name }}</span>
                        @endif
                    </div>
                @endforeach
                <!-- Duplicate 2 -->
                @foreach($brands as $brand)
                    <div class="mx-8 md:mx-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500 flex-shrink-0" aria-hidden="true">
                        @if($brand->hasMedia('brands'))
                            <img src="{{ $brand->getFirstMediaUrl('brands') }}" alt="{{ $brand->name }}" class="h-12 md:h-16 w-auto object-contain hover:scale-110 transition-transform">
                        @else
                            <span class="text-xl font-extrabold text-gray-500">{{ $brand->name }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!-- FAQ Section -->
@if(isset($faqs) && $faqs->count() > 0)
<div class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-primary-950 tracking-tight">Pertanyaan Populer</h2>
            <div class="h-1.5 w-20 bg-accent mt-4 rounded-full mx-auto"></div>
            <p class="mt-4 text-lg text-gray-600">Temukan jawaban cepat untuk pertanyaan yang sering ditanyakan pelanggan.</p>
        </div>
        
        <div class="space-y-4" x-data="{ selected: null }">
            @foreach($faqs as $index => $faq)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-200 hover:shadow-md">
                <button type="button" @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null" class="w-full flex items-center justify-between px-6 py-5 text-left focus:outline-none group">
                    <span class="text-lg font-bold text-primary-900 group-hover:text-primary-700 transition-colors pr-4">{{ $faq->question }}</span>
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center transition-all duration-300" :class="{'rotate-180 bg-accent text-white': selected === {{ $index }}}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </button>
                <div x-show="selected === {{ $index }}" x-collapse>
                    <div class="px-6 pb-6 pt-0 text-gray-600 leading-relaxed border-t border-gray-50 mt-2 pt-4">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('faq') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                Lihat Semua FAQ
                <svg class="w-4 h-4 ml-1 transform hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</div>
@endif

<!-- Blog / Artikel Terbaru -->
@if($latestPosts->count() > 0)
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-primary-950 tracking-tight">Inspirasi & Tips</h2>
                <div class="h-1.5 w-20 bg-accent mt-4 rounded-full"></div>
            </div>
            <a href="{{ route('blog.index') }}" class="hidden sm:flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                Baca Semua Artikel
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestPosts as $post)
            <article class="bg-white rounded-2xl shadow-sm border border-transparent hover:border-primary-100 hover:shadow-2xl transition-all duration-500 overflow-hidden group transform hover:-translate-y-2">
                <a href="{{ route('blog.show', $post->slug ?? $post->id) }}" class="block relative h-60 overflow-hidden">
                    @if($post->hasMedia('posts'))
                        <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                    @else
                        <div class="w-full h-full bg-primary-50 flex items-center justify-center text-primary-400 font-medium">Tanpa Gambar</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-accent shadow-lg uppercase tracking-wider transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        {{ $post->category->name ?? 'Berita' }}
                    </div>
                    
                    <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0 delay-100">
                        <span class="text-sm font-semibold flex items-center">
                            Baca Artikel <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </div>
                </a>
                <div class="p-6 relative">
                    <!-- Date Badge -->
                    <div class="absolute -top-6 right-6 bg-primary-600 text-white w-14 h-14 rounded-2xl flex flex-col items-center justify-center shadow-lg transform rotate-3 group-hover:rotate-0 transition-transform duration-300">
                        <span class="text-xl font-black leading-none">{{ $post->created_at->format('d') }}</span>
                        <span class="text-xs uppercase font-semibold tracking-wider">{{ $post->created_at->format('M') }}</span>
                    </div>
                    
                    <a href="{{ route('blog.show', $post->slug ?? $post->id) }}" class="block mt-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2 leading-snug">
                            {{ $post->title }}
                        </h3>
                    </a>
                    <p class="text-gray-600 line-clamp-3 mb-0 text-sm leading-relaxed">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- CTA Section -->
<div class="bg-primary-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-primary-800 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row">
            <div class="md:w-2/3 p-10 lg:p-16 flex flex-col justify-center">
                <h2 class="text-3xl font-extrabold text-white mb-4 leading-tight">Butuh Konsultasi Material untuk Proyek Anda?</h2>
                <p class="text-primary-200 text-lg mb-8 max-w-xl">Tim ahli kami siap membantu menghitung estimasi kebutuhan dan memberikan rekomendasi material terbaik sesuai anggaran Anda.</p>
                <div class="flex">
                    @php $phoneRaw = preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+6281234567890'); @endphp
                    <a href="https://wa.me/{{ ltrim($phoneRaw, '+') }}" target="_blank" class="bg-accent hover:bg-accent-hover text-white px-8 py-4 rounded-xl font-bold text-lg transition-all flex items-center shadow-lg">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2C6.484 2 2 6.484 2 12.012c0 1.76.455 3.46 1.32 4.965L2 22l5.195-1.305A9.972 9.972 0 0012.012 22c5.528 0 10.012-4.484 10.012-10.012C22.024 6.484 17.54 2 12.012 2zm0 18.31a8.318 8.318 0 01-4.24-1.16l-.304-.18-3.155.795.81-3.076-.197-.312a8.315 8.315 0 01-1.226-4.377c0-4.595 3.738-8.333 8.332-8.333s8.333 3.738 8.333 8.333-3.738 8.333-8.333 8.333zm4.593-6.26c-.252-.126-1.493-.737-1.725-.82-.232-.084-.4-.126-.568.126-.169.253-.653.82-.8 1.01-.148.189-.295.21-.548.084-.252-.126-1.066-.393-2.03-1.25-.748-.667-1.253-1.493-1.4-1.745-.148-.253-.016-.39.11-.516.115-.115.253-.294.378-.442.126-.148.169-.253.253-.42.084-.169.042-.316-.021-.442-.063-.126-.568-1.37-.779-1.874-.206-.495-.415-.428-.568-.436-.147-.008-.315-.01-.484-.01-.168 0-.442.063-.673.316C6.273 8.65 5.58 9.303 5.58 10.63c0 1.326 1.031 2.61 1.178 2.8.148.19 1.91 2.915 4.626 4.084 2.158.926 2.953.948 3.93.801.838-.126 2.458-1.002 2.805-1.97.348-.968.348-1.796.242-1.97-.105-.173-.39-.278-.643-.404z"/></svg>
                        Konsultasi Sekarang
                    </a>
                </div>
            </div>
            <div class="md:w-1/3 relative hidden md:block">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-800 to-transparent z-10"></div>
                <img src="{{ asset('images/hero.png') }}" class="w-full h-full object-cover mix-blend-luminosity opacity-40">
            </div>
        </div>
    </div>
</div>
@endsection
