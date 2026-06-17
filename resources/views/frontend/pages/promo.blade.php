@extends('layouts.app')

@section('title', 'Promo - Toko Bangunan Aneka Jaya')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-4xl font-extrabold text-primary-950 tracking-tight mb-4">Promo Spesial</h1>
            <p class="text-lg text-gray-600">Dapatkan penawaran terbaik dan harga khusus untuk berbagai material bangunan.</p>
        </div>

        @if($promotions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($promotions as $promo)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row group hover:shadow-md transition-shadow">
                        <div class="md:w-2/5 aspect-w-16 aspect-h-10 md:aspect-none bg-gray-200">
                            @if($promo->hasMedia('promotions'))
                                <img src="{{ $promo->getFirstMediaUrl('promotions') }}" alt="{{ $promo->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 p-8">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 md:w-3/5 flex flex-col justify-center">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $promo->title }}</h3>
                            
                            <div class="flex items-center space-x-2 mb-4 text-sm font-medium text-accent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>
                                    @if($promo->start_date && $promo->end_date)
                                        {{ $promo->start_date->format('d M') }} - {{ $promo->end_date->format('d M Y') }}
                                    @else
                                        Berlaku Selamanya
                                    @endif
                                </span>
                            </div>

                            @if($promo->description)
                                <p class="text-gray-600 text-sm mb-6 line-clamp-3">{{ $promo->description }}</p>
                            @endif
                            
                            <div class="mt-auto pt-4">
                                <a href="{{ route('product.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                                    Belanja Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                <h3 class="mt-4 text-lg font-bold text-gray-900">Belum ada promo</h3>
                <p class="mt-1 text-sm text-gray-500">Nantikan penawaran menarik dari kami selanjutnya.</p>
            </div>
        @endif
    </div>
</div>
@endsection
