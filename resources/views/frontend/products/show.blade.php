@extends('layouts.app')

@section('title', $product->name . ' - ' . ($settings['store_name'] ?? 'Toko Bangunan Aneka Jaya'))
@section('meta_description', $product->short_description ?? 'Beli ' . $product->name . ' dengan harga terbaik di ' . ($settings['store_name'] ?? 'Toko Bangunan Aneka Jaya'))
@section('og_type', 'product')
@if($product->hasMedia('products'))
    @section('og_image', $product->getFirstMediaUrl('products'))
@endif

@section('content')
<div class="bg-white">
    <!-- Breadcrumb -->
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex text-sm font-medium text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a></li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg></li>
                    <li><a href="{{ route('product.index') }}" class="hover:text-primary-600">Katalog Produk</a></li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg></li>
                    @if($product->category)
                    <li><a href="{{ route('category.show', $product->category->slug ?? $product->category->id) }}" class="hover:text-primary-600">{{ $product->category->name }}</a></li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg></li>
                    @endif
                    <li class="text-gray-900 truncate max-w-[200px] sm:max-w-xs" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <!-- Product Images Gallery -->
            <div class="flex flex-col gap-4" 
                 x-data="{ 
                    images: [
                        @if($product->hasMedia('products'))
                            @foreach($product->getMedia('products') as $media)
                                '{{ $media->getUrl() }}',
                            @endforeach
                        @endif
                        @if($product->image_urls)
                            @foreach($product->image_urls as $url)
                                '{{ $url }}',
                            @endforeach
                        @endif
                    ],
                    activeImage: 0 
                 }">
                <!-- Main Image -->
                <div class="w-full aspect-square md:aspect-w-4 md:aspect-h-3 lg:aspect-square bg-gray-100 rounded-2xl overflow-hidden shadow-sm relative">
                    <template x-if="images.length > 0">
                        <img :src="images[activeImage]" alt="{{ $product->name }}" class="w-full h-full object-cover object-center transition-opacity duration-300">
                    </template>
                    <template x-if="images.length === 0">
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </template>
                    @if($product->is_featured)
                        <div class="absolute top-4 left-4 bg-accent text-white text-sm font-bold px-3 py-1 rounded-full shadow-md z-10">
                            Unggulan
                        </div>
                    @endif
                </div>
                
                <!-- Thumbnails -->
                <div class="grid grid-cols-4 gap-2 sm:gap-4 mt-2" x-show="images.length > 1">
                    <template x-for="(image, index) in images" :key="index">
                        <button @click="activeImage = index" class="w-full aspect-square rounded-xl overflow-hidden border-2 transition-all"
                                :class="activeImage === index ? 'border-primary-500 ring-2 ring-primary-500/50' : 'border-transparent hover:border-primary-300'">
                            <img :src="image" alt="Thumbnail" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Product Info -->
            <div class="mt-10 px-4 sm:px-0 lg:mt-0">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-semibold text-primary-600 uppercase tracking-wider">{{ $product->brand->name ?? 'Aneka Jaya' }}</p>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center text-xs font-medium text-gray-600 bg-gray-100 px-2.5 py-0.5 rounded-full border border-gray-200">
                            <svg class="w-3.5 h-3.5 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Dilihat {{ $product->views }} kali
                        </span>
                        @if($product->stock > 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                Stok Tersedia ({{ $product->stock }})
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                Stok Habis
                            </span>
                        @endif
                    </div>
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">{{ $product->name }}</h1>
                
                <div class="mb-6 pb-6 border-b border-gray-100">
                    @if($product->original_price > $product->price)
                        <p class="text-lg text-gray-400 line-through mb-1">Rp {{ number_format($product->original_price, 0, ',', '.') }}</p>
                    @endif
                    <p class="text-3xl text-primary-700 font-extrabold">Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/ {{ $product->unit }}</span></p>
                </div>

                @if($product->short_description)
                <div class="mb-6">
                    <p class="text-gray-600 italic">{{ $product->short_description }}</p>
                </div>
                @endif

                <!-- Description -->
                <div class="mb-8 prose prose-sm sm:prose-base text-gray-600 max-w-none">
                    @if($product->description)
                        {!! $product->description !!}
                    @else
                        <p>Belum ada deskripsi lengkap untuk produk ini.</p>
                    @endif
                    
                    @if($product->sku)
                    <p class="mt-4 text-sm text-gray-500">SKU: <span class="font-mono text-gray-900">{{ $product->sku }}</span></p>
                    @endif
                </div>

                <!-- Action CTA -->
                <div class="flex flex-col sm:flex-row gap-4 mt-8">
                    @php 
                        $phoneRaw = preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+6281234567890'); 
                        $waText = "Halo Admin " . ($settings['store_name'] ?? 'Aneka Jaya') . ", saya tertarik dengan produk *" . $product->name . "*. Apakah stoknya masih tersedia?";
                    @endphp
                    <a href="https://wa.me/{{ ltrim($phoneRaw, '+') }}?text={{ urlencode($waText) }}" target="_blank" class="w-full sm:flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-xl transition-colors shadow-lg shadow-green-500/30 flex items-center justify-center text-lg {{ $product->stock <= 0 ? 'opacity-75 cursor-not-allowed' : '' }}">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2C6.484 2 2 6.484 2 12.012c0 1.76.455 3.46 1.32 4.965L2 22l5.195-1.305A9.972 9.972 0 0012.012 22c5.528 0 10.012-4.484 10.012-10.012C22.024 6.484 17.54 2 12.012 2zm0 18.31a8.318 8.318 0 01-4.24-1.16l-.304-.18-3.155.795.81-3.076-.197-.312a8.315 8.315 0 01-1.226-4.377c0-4.595 3.738-8.333 8.332-8.333s8.333 3.738 8.333 8.333-3.738 8.333-8.333 8.333zm4.593-6.26c-.252-.126-1.493-.737-1.725-.82-.232-.084-.4-.126-.568.126-.169.253-.653.82-.8 1.01-.148.189-.295.21-.548.084-.252-.126-1.066-.393-2.03-1.25-.748-.667-1.253-1.493-1.4-1.745-.148-.253-.016-.39.11-.516.115-.115.253-.294.378-.442.126-.148.169-.253.253-.42.084-.169.042-.316-.021-.442-.063-.126-.568-1.37-.779-1.874-.206-.495-.415-.428-.568-.436-.147-.008-.315-.01-.484-.01-.168 0-.442.063-.673.316C6.273 8.65 5.58 9.303 5.58 10.63c0 1.326 1.031 2.61 1.178 2.8.148.19 1.91 2.915 4.626 4.084 2.158.926 2.953.948 3.93.801.838-.126 2.458-1.002 2.805-1.97.348-.968.348-1.796.242-1.97-.105-.173-.39-.278-.643-.404z"/></svg>
                        Pesan via WhatsApp
                    </a>
                </div>

                <!-- Share Action -->
                <div class="mt-6 flex items-center space-x-4 border-t border-gray-100 pt-6">
                    <span class="text-sm font-medium text-gray-500">Bagikan Produk:</span>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode('Cek produk ini: ' . $product->name . ' di ' . url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-[#25D366]/10 text-[#25D366] flex items-center justify-center hover:bg-[#25D366] hover:text-white transition-colors" title="Bagikan ke WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2C6.484 2 2 6.484 2 12.012c0 1.76.455 3.46 1.32 4.965L2 22l5.195-1.305A9.972 9.972 0 0012.012 22c5.528 0 10.012-4.484 10.012-10.012C22.024 6.484 17.54 2 12.012 2zm0 18.31a8.318 8.318 0 01-4.24-1.16l-.304-.18-3.155.795.81-3.076-.197-.312a8.315 8.315 0 01-1.226-4.377c0-4.595 3.738-8.333 8.332-8.333s8.333 3.738 8.333 8.333-3.738 8.333-8.333 8.333zm4.593-6.26c-.252-.126-1.493-.737-1.725-.82-.232-.084-.4-.126-.568.126-.169.253-.653.82-.8 1.01-.148.189-.295.21-.548.084-.252-.126-1.066-.393-2.03-1.25-.748-.667-1.253-1.493-1.4-1.745-.148-.253-.016-.39.11-.516.115-.115.253-.294.378-.442.126-.148.169-.253.253-.42.084-.169.042-.316-.021-.442-.063-.126-.568-1.37-.779-1.874-.206-.495-.415-.428-.568-.436-.147-.008-.315-.01-.484-.01-.168 0-.442.063-.673.316C6.273 8.65 5.58 9.303 5.58 10.63c0 1.326 1.031 2.61 1.178 2.8.148.19 1.91 2.915 4.626 4.084 2.158.926 2.953.948 3.93.801.838-.126 2.458-1.002 2.805-1.97.348-.968.348-1.796.242-1.97-.105-.173-.39-.278-.643-.404z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-[#1877F2]/10 text-[#1877F2] flex items-center justify-center hover:bg-[#1877F2] hover:text-white transition-colors" title="Bagikan ke Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Tautan produk berhasil disalin!');" class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors" title="Salin Tautan">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </button>
                </div>
                
                <div class="mt-8 flex items-center justify-center p-4 bg-primary-50 rounded-xl">
                    <svg class="w-6 h-6 text-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-primary-800 font-medium">Pengiriman cepat! Bisa dikirim di hari yang sama.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if($relatedProducts->count() > 0)
<div class="bg-gray-50 py-16 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Mungkin Anda Juga Tertarik</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
                <a href="{{ route('product.show', $related->slug ?? $related->id) }}" class="relative aspect-square overflow-hidden bg-gray-100 block">
                    @if($related->hasMedia('products'))
                        <img src="{{ $related->getFirstMediaUrl('products') }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </a>
                <div class="p-4 flex flex-col flex-grow">
                    <a href="{{ route('product.show', $related->slug ?? $related->id) }}" class="text-sm font-bold text-gray-900 hover:text-primary-600 transition-colors line-clamp-2 mb-2">
                        {{ $related->name }}
                    </a>
                    <div class="mt-auto">
                        <div class="text-lg font-extrabold text-primary-700">
                            Rp {{ number_format($related->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
