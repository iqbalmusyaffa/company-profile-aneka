<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Toko Bangunan Aneka Jaya') }} - Autentikasi</title>

    @php
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
    @endphp

    @if(isset($settings['site_favicon']) && $settings['site_favicon'])
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings['site_favicon']) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏢</text></svg>">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-white min-h-screen flex">

    <!-- Left Side: Visual / Image -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary-950">
        <!-- Background Image -->
        <img src="{{ asset('images/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-luminosity transform scale-105 transition-transform duration-[20s] hover:scale-110" alt="Hardware Store">
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-950/90 via-primary-900/60 to-transparent"></div>
        
        <!-- Content on Image -->
        <div class="relative z-10 flex flex-col justify-between p-16 w-full h-full">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                @if(isset($settings['site_logo']) && $settings['site_logo'])
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['store_name'] ?? 'Logo' }}" class="h-12 w-auto object-contain bg-white/10 p-1 rounded-xl">
                @else
                    <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center text-primary-950 font-extrabold text-2xl shadow-lg flex-shrink-0">
                        {{ substr($settings['store_name'] ?? 'AJ', 0, 2) }}
                    </div>
                @endif
                <span class="font-bold text-3xl tracking-tight text-white">{{ $settings['store_name'] ?? 'Aneka Jaya' }}</span>
            </a>

            <!-- Text Content -->
            <div class="mb-12">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-accent text-sm font-semibold mb-6">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    Sistem Manajemen Terpadu
                </div>
                <h1 class="text-5xl font-extrabold text-white leading-tight mb-6">
                    Kelola Bisnis Material Anda dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-200">Lebih Cerdas</span>
                </h1>
                <p class="text-primary-200 text-lg max-w-md leading-relaxed font-light">
                    Akses kontrol penuh atas katalog produk, analisis penjualan, dan manajemen konten dalam satu dasbor yang tangguh dan mudah digunakan.
                </p>
            </div>
            
            <!-- Footer on image -->
            <div class="text-primary-400 text-sm flex items-center gap-4">
                <span>&copy; {{ date('Y') }} Toko Bangunan Aneka Jaya.</span>
                <span class="w-1 h-1 rounded-full bg-primary-600"></span>
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- Right Side: Form Area -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 overflow-y-auto">
        <div class="w-full max-w-md">
            
            <!-- Mobile Logo (Visible only on small screens) -->
            <div class="flex lg:hidden justify-center mb-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['store_name'] ?? 'Logo' }}" class="h-10 w-auto object-contain">
                    @else
                        <div class="w-10 h-10 bg-primary-900 rounded-lg flex items-center justify-center text-white font-extrabold text-xl shadow-md flex-shrink-0">
                            {{ substr($settings['store_name'] ?? 'AJ', 0, 2) }}
                        </div>
                    @endif
                    <span class="font-bold text-2xl tracking-tight text-primary-900">{{ $settings['store_name'] ?? 'Aneka Jaya' }}</span>
                </a>
            </div>

            <!-- Form Content Injected Here -->
            <div class="bg-white">
                {{ $slot }}
            </div>
            
        </div>
    </div>

</body>
</html>
