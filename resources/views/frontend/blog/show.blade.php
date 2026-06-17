@extends('layouts.app')

@section('title', $post->title . ' - Blog ' . ($settings['store_name'] ?? 'Toko Bangunan Aneka Jaya'))
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content), 150))
@section('og_type', 'article')
@if($post->hasMedia('posts'))
    @section('og_image', $post->getFirstMediaUrl('posts'))
@endif

@section('content')
<!-- Hero Article -->
<div class="bg-gray-50 py-12 border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-primary-700 bg-primary-100 mb-6">
            {{ $post->category->name ?? 'Berita' }}
        </div>
        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">{{ $post->title }}</h1>
        
        <div class="flex items-center justify-center text-sm text-gray-500 gap-6">
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ $post->created_at->format('d M Y') }}
            </span>
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Ditulis oleh {{ $post->author->name ?? 'Admin' }}
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col lg:flex-row gap-12">
    <!-- Main Article -->
    <div class="lg:w-2/3">
        @if($post->hasMedia('posts'))
        <div class="w-full aspect-video md:aspect-[21/9] rounded-2xl overflow-hidden shadow-lg mb-12">
            <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="prose prose-lg sm:prose-xl prose-primary max-w-none text-gray-700">
            {!! $post->content !!}
        </div>
        
        <!-- Share -->
        <div class="mt-12 pt-8 border-t border-gray-100 flex items-center gap-4">
            <span class="font-bold text-gray-900">Bagikan Artikel:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>
            </a>
            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2C6.484 2 2 6.484 2 12.012c0 1.76.455 3.46 1.32 4.965L2 22l5.195-1.305A9.972 9.972 0 0012.012 22c5.528 0 10.012-4.484 10.012-10.012C22.024 6.484 17.54 2 12.012 2zm0 18.31a8.318 8.318 0 01-4.24-1.16l-.304-.18-3.155.795.81-3.076-.197-.312a8.315 8.315 0 01-1.226-4.377c0-4.595 3.738-8.333 8.332-8.333s8.333 3.738 8.333 8.333-3.738 8.333-8.333 8.333zm4.593-6.26c-.252-.126-1.493-.737-1.725-.82-.232-.084-.4-.126-.568.126-.169.253-.653.82-.8 1.01-.148.189-.295.21-.548.084-.252-.126-1.066-.393-2.03-1.25-.748-.667-1.253-1.493-1.4-1.745-.148-.253-.016-.39.11-.516.115-.115.253-.294.378-.442.126-.148.169-.253.253-.42.084-.169.042-.316-.021-.442-.063-.126-.568-1.37-.779-1.874-.206-.495-.415-.428-.568-.436-.147-.008-.315-.01-.484-.01-.168 0-.442.063-.673.316C6.273 8.65 5.58 9.303 5.58 10.63c0 1.326 1.031 2.61 1.178 2.8.148.19 1.91 2.915 4.626 4.084 2.158.926 2.953.948 3.93.801.838-.126 2.458-1.002 2.805-1.97.348-.968.348-1.796.242-1.97-.105-.173-.39-.278-.643-.404z"/></svg>
            </a>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:w-1/3">
        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Artikel Terkait</h3>
            <div class="space-y-6">
                @foreach($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug ?? $related->id) }}" class="flex items-center gap-4 group">
                    <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                        @if($related->hasMedia('posts'))
                            <img src="{{ $related->getFirstMediaUrl('posts') }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm leading-tight group-hover:text-primary-600 transition-colors line-clamp-2 mb-1">{{ $related->title }}</h4>
                        <p class="text-xs text-gray-500">{{ $related->created_at->format('d M Y') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Banner Ads -->
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
@endsection
