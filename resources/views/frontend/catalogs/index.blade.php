@extends('layouts.app')

@section('title', 'Katalog PDF')

@section('content')
<!-- Page Header -->
<div class="bg-primary-900 py-16 sm:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-900 to-primary-800"></div>
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6 tracking-tight">Katalog <span class="text-primary-300">Produk</span></h1>
        <p class="text-xl text-primary-100 max-w-2xl mx-auto font-medium">Unduh katalog terbaru kami untuk melihat daftar produk dan penawaran spesial.</p>
    </div>
</div>

<!-- Main Content -->
<div class="py-12 sm:py-16 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search and Filter Section -->
        <div class="mb-10 bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search Bar -->
            <form action="{{ route('catalogs.download') }}" method="GET" class="w-full md:w-1/2 relative">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..." 
                    class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                <svg class="w-6 h-6 text-gray-400 absolute left-4 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <button type="submit" class="hidden"></button>
            </form>

            <!-- Tabs/Categories -->
            <div class="w-full md:w-auto flex overflow-x-auto pb-2 md:pb-0 hide-scrollbar gap-2">
                <a href="{{ route('catalogs.download', ['search' => request('search')]) }}" 
                   class="whitespace-nowrap px-5 py-2.5 rounded-full font-medium text-sm transition-all {{ !request('category') || request('category') == 'all' ? 'bg-primary-600 text-white shadow-md shadow-primary-500/30' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('catalogs.download', ['category' => $cat, 'search' => request('search')]) }}" 
                       class="whitespace-nowrap px-5 py-2.5 rounded-full font-medium text-sm transition-all {{ request('category') == $cat ? 'bg-primary-600 text-white shadow-md shadow-primary-500/30' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- List Layout -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @forelse($catalogs as $catalog)
                <div class="group flex flex-col sm:flex-row items-center p-5 border-b border-gray-100 hover:bg-gray-50 transition-colors last:border-0 gap-4 sm:gap-6">
                    <!-- Icon -->
                    <div class="w-14 h-14 shrink-0 bg-red-50 text-red-500 rounded-xl flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>

                    <!-- Info -->
                    <div class="flex-grow text-center sm:text-left w-full">
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary-600 transition-colors">{{ $catalog->title }}</h3>
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 mt-1.5 text-sm">
                            @if($catalog->category)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md font-medium bg-primary-50 text-primary-700 text-xs border border-primary-100">
                                    {{ $catalog->category }}
                                </span>
                            @endif
                            <span class="text-gray-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @if($catalog->publish_date)
                                    {{ $catalog->publish_date->translatedFormat('d F Y') }}
                                @else
                                    {{ $catalog->created_at->translatedFormat('d F Y') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="w-full sm:w-auto shrink-0 mt-2 sm:mt-0">
                        @if($catalog->hasMedia('catalogs'))
                            @php
                                $media = $catalog->getFirstMedia('catalogs');
                                $pdfUrl = asset('storage/' . $media->id . '/' . $media->file_name);
                            @endphp
                            <a href="{{ $pdfUrl }}" target="_blank" class="w-full sm:w-auto px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all shadow-md shadow-red-500/20 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh
                            </a>
                        @else
                            <button disabled class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 text-gray-400 font-bold rounded-xl cursor-not-allowed text-sm">
                                Tidak Tersedia
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="py-20 text-center">
                    <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Dokumen Tidak Ditemukan</h3>
                    @if(request('search') || request('category'))
                        <p class="text-gray-500 max-w-md mx-auto">Tidak ada dokumen yang cocok dengan pencarian atau filter Anda.</p>
                        <a href="{{ route('catalogs.download') }}" class="mt-4 inline-flex items-center text-primary-600 font-medium hover:text-primary-700">
                            Reset Filter
                        </a>
                    @else
                        <p class="text-gray-500 max-w-md mx-auto">Saat ini belum ada dokumen yang tersedia untuk diunduh.</p>
                    @endif
                </div>
            @endforelse
        </div>
        
        @if($catalogs->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $catalogs->links() }}
            </div>
        @endif
        
    </div>
</div>
@endsection
