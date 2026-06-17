@extends('layouts.app')

@section('title', 'FAQ - Toko Bangunan Aneka Jaya')

@section('content')
<div class="bg-white py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-primary-950 tracking-tight mb-4">Pertanyaan yang Sering Diajukan</h1>
            <p class="text-lg text-gray-600">Temukan jawaban untuk pertanyaan-pertanyaan umum seputar layanan dan produk kami.</p>
        </div>

        @if($faqs->count() > 0)
            <div class="space-y-4" x-data="{ selected: null }">
                @foreach($faqs as $index => $faq)
                    <div class="bg-gray-50 rounded-xl border border-gray-100 overflow-hidden transition-all duration-200">
                        <button 
                            type="button" 
                            class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null"
                        >
                            <span class="font-bold text-gray-900 pr-4">{{ $faq->question }}</span>
                            <span class="text-primary-500 transition-transform duration-200 shrink-0" :class="{'rotate-180': selected === {{ $index }}}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        
                        <div 
                            class="px-6 overflow-hidden transition-all duration-300 max-h-0"
                            x-ref="container{{ $index }}"
                            x-bind:style="selected === {{ $index }} ? 'max-height: ' + $refs.container{{ $index }}.scrollHeight + 'px' : ''"
                        >
                            <div class="pb-5 pt-2 text-gray-600">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 text-center bg-primary-50 rounded-2xl p-8 border border-primary-100">
                <h3 class="text-lg font-bold text-primary-900 mb-2">Masih memiliki pertanyaan?</h3>
                <p class="text-primary-700 mb-6">Tim dukungan pelanggan kami siap membantu Anda dengan informasi lebih lanjut.</p>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                    Hubungi Kami
                </a>
            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-2xl border border-gray-100">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-4 text-lg font-bold text-gray-900">Belum ada FAQ</h3>
                <p class="mt-1 text-sm text-gray-500">Daftar pertanyaan yang sering diajukan sedang diperbarui.</p>
            </div>
        @endif
    </div>
</div>
@endsection
