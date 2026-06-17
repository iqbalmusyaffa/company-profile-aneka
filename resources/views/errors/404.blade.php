@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan | ' . ($settings['store_name'] ?? 'Toko Bangunan Aneka Jaya'))

@section('content')
<div class="flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 bg-gray-50 overflow-hidden relative" style="min-height: 80vh;">
    
    <!-- Decorative Background Elements -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-200 rounded-full opacity-30 pointer-events-none" style="width: 300px; height: 300px; filter: blur(60px); animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-yellow-100 rounded-full opacity-20 pointer-events-none" style="width: 400px; height: 400px; margin-left: 40px; margin-top: 40px; filter: blur(60px);"></div>
    
    <div class="relative z-10 text-center max-w-2xl mx-auto py-16">
        <!-- 404 Text Graphic -->
        <h1 class="font-extrabold tracking-tighter" style="font-size: 8rem; line-height: 1; color: #2a6396; text-shadow: 2px 4px 10px rgba(0,0,0,0.1);">
            404
        </h1>
        
        <h2 class="mt-6 text-3xl font-bold text-gray-900 tracking-tight sm:text-4xl">
            Oops! Halaman Tidak Ditemukan
        </h2>
        
        <p class="mt-4 text-lg text-gray-600">
            Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia. 
            Mari kembali ke jalan yang benar.
        </p>
        
        <!-- Action Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-lg text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300" style="background-color: #2a6396;">
                <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
            
            <a href="{{ route('contact.index') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3.5 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 hover:text-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 shadow-sm hover:shadow-md">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
