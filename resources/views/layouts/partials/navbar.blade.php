<nav x-data="{ open: false, isScrolled: false }"
     @scroll.window="isScrolled = (window.pageYOffset > 20) ? true : false"
     :class="{ 'shadow-md py-3': isScrolled, 'py-5': !isScrolled }"
     class="bg-white sticky top-0 z-40 transition-all duration-300 w-full border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['store_name'] ?? 'Logo' }}" class="h-10 w-auto object-contain">
                    @else
                        <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                            {{ substr($settings['store_name'] ?? 'AJ', 0, 2) }}
                        </div>
                    @endif
                    <span class="font-bold text-xl tracking-tight text-primary-900 hidden sm:block">{{ $settings['store_name'] ?? 'Aneka Jaya' }}</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-600 font-medium transition-colors">Beranda</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-primary-600 font-medium transition-colors">Tentang Kami</a>

                <div class="relative group" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false">
                    <button class="flex items-center text-gray-600 hover:text-primary-600 font-medium transition-colors">
                        Katalog Produk
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <!-- Dropdown -->
                    <div x-show="dropdownOpen" x-transition.opacity class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-xl py-2 z-50">
                        <a href="{{ route('product.index') }}" class="block px-4 py-2 text-sm font-semibold text-primary-700 hover:bg-primary-50 border-b border-gray-50">Semua Produk</a>
                        @if(isset($navCategories) && $navCategories->count() > 0)
                            @foreach($navCategories as $category)
                                <a href="{{ route('category.show', $category->slug ?? $category->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">{{ $category->name }}</a>
                            @endforeach
                        @else
                            <a href="#" class="block px-4 py-2 text-sm text-gray-400 italic">Belum ada kategori</a>
                        @endif
                    </div>
                </div>

                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-primary-600 font-medium transition-colors">Blog</a>
                <a href="{{ route('faq') }}" class="text-gray-600 hover:text-primary-600 font-medium transition-colors">FAQ</a>
                <a href="{{ route('contact.index') }}" class="text-gray-600 hover:text-primary-600 font-medium transition-colors">Kontak</a>
                <a href="{{ route('catalogs.download') }}" class="text-gray-600 hover:text-primary-600 font-medium transition-colors">Download</a>
            </div>

            <!-- CTA Desktop -->
            <div class="hidden md:flex items-center">
                <a href="{{ route('contact.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm shadow-primary-600/30">
                    Minta Penawaran
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Buka menu utama</span>
                    <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" x-cloak class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-cloak class="md:hidden border-t border-gray-100" id="mobile-menu" x-transition>
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-primary-900 bg-primary-50">Beranda</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-900 hover:bg-primary-50">Tentang Kami</a>
            <div x-data="{ openKatalog: false }" class="space-y-1">
                <button @click="openKatalog = !openKatalog" class="w-full flex items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-900 hover:bg-primary-50 transition-colors">
                    <span>Katalog Produk</span>
                    <svg :class="{'rotate-180': openKatalog}" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openKatalog" x-transition.opacity class="pl-4 pr-2 py-1 space-y-1 border-l-2 border-primary-100 ml-4 mb-2">
                    <a href="{{ route('product.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-primary-700 hover:bg-primary-50 transition-colors">Semua Produk</a>
                    @if(isset($navCategories) && $navCategories->count() > 0)
                        @foreach($navCategories as $category)
                            <a href="{{ route('category.show', $category->slug ?? $category->id) }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-primary-900 hover:bg-primary-50 transition-colors">{{ $category->name }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
            <a href="{{ route('blog.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-900 hover:bg-primary-50">Blog</a>
            <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-900 hover:bg-primary-50">FAQ</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-900 hover:bg-primary-50">Kontak</a>
            <a href="{{ route('catalogs.download') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-900 hover:bg-primary-50">Download</a>
            <div class="mt-4 px-3">
                <a href="{{ route('contact.index') }}" class="block w-full text-center bg-primary-600 hover:bg-primary-700 text-white px-4 py-3 rounded-lg font-medium">
                    Minta Penawaran
                </a>
            </div>
        </div>
    </div>
</nav>
