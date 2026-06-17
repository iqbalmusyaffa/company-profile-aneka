@extends('layouts.app')

@section('title', 'Galeri - Toko Bangunan Aneka Jaya')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-4xl font-extrabold text-primary-950 tracking-tight mb-4">Galeri Kami</h1>
            <p class="text-lg text-gray-600">Dokumentasi kegiatan, proyek, dan pengiriman material bangunan dari Toko Aneka Jaya.</p>
        </div>

        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleries as $gallery)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="aspect-w-16 aspect-h-10 w-full overflow-hidden bg-gray-200">
                            @if($gallery->hasMedia('galleries'))
                                <img src="{{ $gallery->getFirstMediaUrl('galleries') }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $gallery->title }}</h3>
                            @if($gallery->description)
                                <p class="text-gray-600 text-sm line-clamp-3">{{ $gallery->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <h3 class="mt-4 text-lg font-bold text-gray-900">Belum ada foto</h3>
                <p class="mt-1 text-sm text-gray-500">Galeri foto sedang dalam tahap pembaruan.</p>
            </div>
        @endif
    </div>
</div>
@endsection
