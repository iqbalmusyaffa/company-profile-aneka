<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - @yield('title', 'Dashboard')</title>

    @if(isset($settings['site_favicon']) && $settings['site_favicon'])
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings['site_favicon']) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏢</text></svg>">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full font-sans antialiased text-gray-900" x-data="{ sidebarOpen: false }">

    <div class="flex h-full w-full overflow-hidden">
        
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-gray-900 to-gray-950 border-r border-gray-800 text-gray-300 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto flex flex-col shadow-2xl"
             :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b border-gray-800 px-6 shrink-0 relative overflow-hidden">
                <div class="absolute inset-0 bg-primary-500/10 opacity-50 blur-xl"></div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 relative z-10 w-full">
                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="h-10 w-auto object-contain bg-white/10 p-1 rounded-lg">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-primary-500/30 flex-shrink-0">
                            {{ substr($settings['store_name'] ?? 'AJ', 0, 2) }}
                        </div>
                    @endif
                    <span class="font-extrabold text-xl tracking-tight text-white truncate">{{ $settings['store_name'] ?? 'Aneka Jaya' }}</span>
                </a>
            </div>

            <!-- Menus -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto custom-scrollbar">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium">Dasbor</span>
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.analytics.index') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.analytics.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span class="font-medium">Analitik Lanjutan</span>
                </a>
                
                <p class="px-4 pt-6 pb-2 text-xs font-bold uppercase tracking-wider text-gray-500">Katalog</p>
                <a href="{{ route('admin.products.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.products.index', 'admin.products.create', 'admin.products.edit') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.products.index', 'admin.products.create', 'admin.products.edit') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span class="font-medium">Produk</span>
                </a>
                <a href="{{ route('admin.products.report') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.products.report') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.products.report') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span class="font-medium">Laporan Produk</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <span class="font-medium">Kategori</span>
                </a>
                <a href="{{ route('admin.brands.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.brands.index', 'admin.brands.create', 'admin.brands.edit') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.brands.index', 'admin.brands.create', 'admin.brands.edit') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-medium">Merek</span>
                </a>
                <a href="{{ route('admin.brands.report') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.brands.report') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.brands.report') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span class="font-medium">Laporan Merek</span>
                </a>

                <p class="px-4 pt-6 pb-2 text-xs font-bold uppercase tracking-wider text-gray-500">Konten</p>
                <a href="{{ route('admin.posts.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.posts.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.posts.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <span class="font-medium">Artikel Blog</span>
                </a>
                <a href="{{ route('admin.galleries.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.galleries.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.galleries.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="font-medium">Galeri</span>
                </a>
                <a href="{{ route('admin.promotions.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.promotions.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.promotions.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    <span class="font-medium">Promo</span>
                </a>
                <a href="{{ route('admin.catalogs.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.catalogs.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.catalogs.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span class="font-medium">Katalog PDF</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.faqs.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.faqs.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">FAQ</span>
                </a>

                <p class="px-4 pt-6 pb-2 text-xs font-bold uppercase tracking-wider text-gray-500">Masukan Pengguna</p>
                <a href="{{ route('admin.feedbacks.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.feedbacks.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.feedbacks.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    <span class="font-medium flex-1">Kritik & Saran</span>
                    @php
                        $unreadFeedback = \App\Models\Feedback::where('is_read', false)->count();
                    @endphp
                    @if($unreadFeedback > 0)
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadFeedback }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.bug-reports.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.bug-reports.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.bug-reports.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span class="font-medium flex-1">Laporan Bug</span>
                    @php
                        $unreadBug = \App\Models\BugReport::where('is_read', false)->count();
                    @endphp
                    @if($unreadBug > 0)
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadBug }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.testimonials.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <span class="font-medium">Testimoni</span>
                </a>
                
                <p class="px-4 pt-6 pb-2 text-xs font-bold uppercase tracking-wider text-gray-500">Sistem</p>
                <a href="{{ route('admin.users.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="font-medium">Manajemen Admin</span>
                </a>
                <a href="{{ route('admin.activity-logs.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.activity-logs.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.activity-logs.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <span class="font-medium">Log Aktivitas</span>
                </a>
                <a href="{{ route('admin.visitors.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.visitors.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.visitors.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span class="font-medium">Data Pengunjung</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-medium">Web Settings</span>
                </a>
                <a href="{{ route('admin.theme.examples') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.theme.examples') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.theme.examples') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                    <span class="font-medium">Referensi Warna</span>
                </a>
                <a href="{{ route('admin.seo-pages.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.seo-pages.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.seo-pages.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="font-medium">SEO Pages</span>
                </a>
                <a href="{{ route('admin.backups.index') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.backups.*') ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-lg shadow-primary-500/30' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.backups.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    <span class="font-medium">Backup Database</span>
                </a>
            </nav>
            
            <!-- User Profile Bottom -->
            <div class="px-4 mt-auto">
                <a href="{{ route('profile.edit') }}" class="group flex items-center p-3 mt-4 bg-gray-900/50 hover:bg-gray-800 rounded-2xl border border-gray-800 transition-all duration-300">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-gray-700 group-hover:border-primary-500 transition-colors">
                    @else
                        <div class="w-10 h-10 rounded-full bg-primary-900/50 text-primary-400 flex items-center justify-center font-bold text-sm border-2 border-gray-700 group-hover:border-primary-500 transition-colors">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="ml-3 overflow-hidden">
                        <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">Admin</p>
                    </div>
                </a>
            </div>

            <div class="p-4 border-t border-gray-800 mt-4 shrink-0 bg-gray-950/50 backdrop-blur-sm mx-4 mb-4 rounded-2xl">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-gray-300 hover:text-white bg-white/5 hover:bg-red-500/10 hover:text-red-400 border border-white/5 hover:border-red-500/20 rounded-xl transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Header -->
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 h-20 shrink-0 flex items-center justify-between px-4 sm:px-8 z-40 sticky top-0">
                <!-- Mobile menu button -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors focus:outline-none">
                        <span class="sr-only">Buka menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-lg sm:text-2xl font-extrabold text-gray-800 hidden sm:block tracking-tight">@yield('title')</h1>
                </div>
                
                <div class="flex items-center gap-2 sm:gap-4">
                    <!-- Notifications Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="relative p-2 text-gray-500 hover:text-primary-600 hover:bg-gray-100 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            @php
                                $recentLogsCount = \Spatie\Activitylog\Models\Activity::where('created_at', '>=', now()->subHours(24))->count();
                            @endphp
                            @if($recentLogsCount > 0)
                                <span class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                            @endif
                        </button>

                        <div x-show="open" x-transition.opacity class="absolute -right-14 sm:right-0 mt-2 w-[280px] sm:w-80 max-w-[90vw] bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                                <h3 class="text-sm font-bold text-gray-900">Aktivitas Terkini</h3>
                                <a href="{{ route('admin.activity-logs.index') }}" class="text-xs text-primary-600 hover:text-primary-800">Lihat Semua</a>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse(\Spatie\Activitylog\Models\Activity::with('causer')->latest()->take(5)->get() as $log)
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0">
                                        <p class="text-sm font-medium text-gray-900">{{ $log->description }}</p>
                                        <p class="text-xs text-gray-500 mt-1 flex justify-between gap-2">
                                            <span class="truncate">Oleh: {{ $log->causer->name ?? 'Sistem' }}</span>
                                            <span class="shrink-0">{{ $log->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                @empty
                                    <div class="px-4 py-4 text-center text-sm text-gray-500">Tidak ada aktivitas.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" target="_blank" class="px-3 sm:px-5 py-2.5 bg-primary-50 text-primary-600 hover:bg-primary-100 hover:text-primary-700 rounded-xl font-semibold text-sm transition-colors flex items-center gap-2">
                        <span class="hidden sm:inline">Lihat Website</span>
                        <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                
                @yield('content')
            </main>
        </div>

        <!-- Overlay for mobile sidebar -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden"></div>

    </div>

    <!-- jQuery (required for Toastr) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "4000"
        };
        
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
    @stack('scripts')
</body>
</html>
