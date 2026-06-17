@extends('layouts.app')

@section('title', isset($category) ? 'Kategori: ' . $category->name : (isset($brand) ? 'Merek: ' . $brand->name : 'Katalog Produk Lengkap'))

@section('content')
<div class="bg-primary-50 py-8 border-b border-primary-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-primary-950 mb-2">
            @if(isset($category))
                Kategori: {{ $category->name }}
            @elseif(isset($brand))
                Merek: {{ $brand->name }}
            @elseif(request('search'))
                Pencarian: "{{ request('search') }}"
            @else
                Katalog Produk Lengkap
            @endif
        </h1>
        <p class="text-primary-600">Temukan berbagai material bangunan berkualitas tinggi untuk proyek Anda.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8">
    <!-- Sidebar Filter -->
    <div class="w-full md:w-1/4">
        <form action="{{ route('product.index') }}" method="GET" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
            <h3 class="text-lg font-bold text-primary-900 mb-4 pb-2 border-b border-gray-100">Pencarian</h3>
            
            <div class="mb-6">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Produk</label>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Contoh: Semen Gresik">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Filter Kategori</h4>
                <div class="space-y-2">
                    <a href="{{ route('product.index') }}" class="flex items-center text-sm {{ !isset($category) && !isset($brand) ? 'text-primary-600 font-bold' : 'text-gray-600 hover:text-primary-600' }}">
                        Semua Produk
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('category.show', $cat->slug ?? $cat->id) }}" class="flex items-center text-sm {{ (isset($category) && $category->id == $cat->id) ? 'text-primary-600 font-bold' : 'text-gray-600 hover:text-primary-600' }}">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Filter Merek</h4>
                <select onchange="if(this.value) window.location.href=this.value;" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 sm:text-sm bg-white cursor-pointer">
                    <option value="{{ route('product.index') }}">Semua Merek</option>
                    @foreach($brands as $brnd)
                    <option value="{{ route('brand.show', $brnd->slug ?? $brnd->id) }}" {{ (isset($brand) && $brand->id == $brnd->id) ? 'selected' : '' }}>
                        {{ $brnd->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">Terapkan Pencarian</button>
        </form>
    </div>

    <!-- Product Grid -->
    <div class="w-full md:w-3/4">
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
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
                    @if($product->stock <= 0)
                        <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center">
                            <span class="bg-gray-800 text-white px-4 py-2 rounded-lg font-bold text-sm">Stok Habis</span>
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

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
        @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Produk Tidak Ditemukan</h3>
            <p class="text-gray-500">Maaf, kami tidak dapat menemukan produk yang sesuai dengan kriteria pencarian Anda.</p>
            <a href="{{ route('product.index') }}" class="mt-6 bg-primary-50 text-primary-600 hover:bg-primary-100 px-6 py-2 rounded-lg font-medium transition-colors">Lihat Semua Produk</a>
        </div>
        @endif
    </div>
</div>
@endsection
