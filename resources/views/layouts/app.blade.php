<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Toko Bangunan Aneka Jaya'))</title>

        @if(isset($settings['site_favicon']) && $settings['site_favicon'])
            <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings['site_favicon']) }}">
        @else
            <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏢</text></svg>">
        @endif
        
        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('meta_description', $settings['store_description'] ?? 'Toko Bangunan Aneka Jaya menyediakan berbagai macam material bahan bangunan berkualitas di Banyuwangi.')">
        <meta name="keywords" content="toko bangunan, bahan bangunan, material bangunan, semen, besi, cat, banyuwangi">
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Open Graph / Facebook / WhatsApp -->
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="@yield('title', $settings['store_name'] ?? 'Toko Bangunan Aneka Jaya')">
        <meta property="og:description" content="@yield('meta_description', $settings['store_description'] ?? 'Toko Bangunan Aneka Jaya menyediakan berbagai macam material bahan bangunan berkualitas di Banyuwangi.')">
        <meta property="og:image" content="@yield('og_image', asset('images/hero.png'))">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="@yield('title', $settings['store_name'] ?? 'Toko Bangunan Aneka Jaya')">
        <meta property="twitter:description" content="@yield('meta_description', $settings['store_description'] ?? 'Toko Bangunan Aneka Jaya menyediakan berbagai macam material bahan bangunan berkualitas di Banyuwangi.')">
        <meta property="twitter:image" content="@yield('og_image', asset('images/hero.png'))">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Schema Markup untuk SEO Lokal -->
        <script type="application/ld+json">
        {
          "@@context": "https://schema.org",
          "@@type": "HardwareStore",
          "name": "Toko Bangunan Aneka Jaya",
          "image": "{{ asset('images/hero.png') }}",
          "@@id": "{{ url('/') }}",
          "url": "{{ url('/') }}",
          "telephone": "{{ $settings['phone'] ?? '+6281234567890' }}",
          "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Jl. Raya Banyuwangi No. 123, Kecamatan Genteng",
            "addressLocality": "Banyuwangi",
            "addressRegion": "Jawa Timur",
            "postalCode": "68465",
            "addressCountry": "ID"
          },
          "geo": {
            "@@type": "GeoCoordinates",
            "latitude": -8.3686,
            "longitude": 114.1524
          },
          "priceRange": "$$"
        }
        </script>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-800 bg-gray-50 flex flex-col min-h-screen">
        
        <!-- Navigation -->
        @include('layouts.partials.navbar')

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')

        <!-- WhatsApp CTA -->
        @php $phoneRaw = preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+6281234567890'); @endphp
        <a href="https://wa.me/{{ ltrim($phoneRaw, '+') }}" target="_blank" class="fixed bottom-6 right-6 z-50 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-transform transform hover:scale-110 flex items-center justify-center animate-bounce" aria-label="Chat WhatsApp">
            <span class="absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75 animate-ping"></span>
            <svg class="w-8 h-8 relative" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2C6.484 2 2 6.484 2 12.012c0 1.76.455 3.46 1.32 4.965L2 22l5.195-1.305A9.972 9.972 0 0012.012 22c5.528 0 10.012-4.484 10.012-10.012C22.024 6.484 17.54 2 12.012 2zm0 18.31a8.318 8.318 0 01-4.24-1.16l-.304-.18-3.155.795.81-3.076-.197-.312a8.315 8.315 0 01-1.226-4.377c0-4.595 3.738-8.333 8.332-8.333s8.333 3.738 8.333 8.333-3.738 8.333-8.333 8.333zm4.593-6.26c-.252-.126-1.493-.737-1.725-.82-.232-.084-.4-.126-.568.126-.169.253-.653.82-.8 1.01-.148.189-.295.21-.548.084-.252-.126-1.066-.393-2.03-1.25-.748-.667-1.253-1.493-1.4-1.745-.148-.253-.016-.39.11-.516.115-.115.253-.294.378-.442.126-.148.169-.253.253-.42.084-.169.042-.316-.021-.442-.063-.126-.568-1.37-.779-1.874-.206-.495-.415-.428-.568-.436-.147-.008-.315-.01-.484-.01-.168 0-.442.063-.673.316C6.273 8.65 5.58 9.303 5.58 10.63c0 1.326 1.031 2.61 1.178 2.8.148.19 1.91 2.915 4.626 4.084 2.158.926 2.953.948 3.93.801.838-.126 2.458-1.002 2.805-1.97.348-.968.348-1.796.242-1.97-.105-.173-.39-.278-.643-.404z"/></svg>
        </a>

        @stack('scripts')
    </body>
</html>
