<footer class="bg-primary-950 pt-16 pb-8 border-t border-primary-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand -->
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-6">
                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                        <!-- Menggunakan bg-white/10 agar jika logonya gelap tetap terlihat di background footer yang gelap -->
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['store_name'] ?? 'Logo' }}" class="h-10 w-auto object-contain bg-white/10 p-1 rounded-lg">
                    @else
                        <div class="w-10 h-10 bg-accent rounded-lg flex items-center justify-center text-primary-950 font-bold text-xl flex-shrink-0">
                            {{ substr($settings['store_name'] ?? 'AJ', 0, 2) }}
                        </div>
                    @endif
                    <span class="font-bold text-2xl tracking-tight text-white">{{ $settings['store_name'] ?? 'Aneka Jaya' }}</span>
                </a>
                <p class="text-primary-200 text-sm leading-relaxed mb-6">
                    {{ $settings['store_description'] ?? 'Mitra terpercaya untuk kebutuhan material bangunan Anda di Banyuwangi. Menyediakan produk berkualitas dengan harga kompetitif untuk proyek skala kecil maupun besar.' }}
                </p>
                <div class="flex space-x-4">
                    <!-- Social Links -->
                    @if(!empty($settings['facebook']))
                    <a href="{{ $settings['facebook'] }}" target="_blank" class="w-10 h-10 rounded-full bg-primary-900 flex items-center justify-center text-primary-300 hover:bg-primary-600 hover:text-white transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    @endif
                    @if(!empty($settings['instagram']))
                    <a href="{{ $settings['instagram'] }}" target="_blank" class="w-10 h-10 rounded-full bg-primary-900 flex items-center justify-center text-primary-300 hover:bg-primary-600 hover:text-white transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Tautan Cepat -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-6 tracking-wide">Tautan Cepat</h3>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="text-primary-300 hover:text-accent transition-colors text-sm">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="text-primary-300 hover:text-accent transition-colors text-sm">Tentang Perusahaan</a></li>
                    <li><a href="{{ route('product.index') }}" class="text-primary-300 hover:text-accent transition-colors text-sm">Katalog Produk</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-primary-300 hover:text-accent transition-colors text-sm">Artikel Blog</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-primary-300 hover:text-accent transition-colors text-sm">Galeri Proyek</a></li>
                    <li><a href="{{ route('catalogs.download') }}" class="text-primary-300 hover:text-accent transition-colors text-sm">Download</a></li>
                    <li><a href="{{ route('faq') }}" class="text-primary-300 hover:text-accent transition-colors text-sm">Tanya Jawab (FAQ)</a></li>
                </ul>
            </div>

            <!-- Kategori Utama -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-6 tracking-wide">Kategori Utama</h3>
                <ul class="space-y-4">
                    @foreach($navCategories->take(5) as $category)
                    <li><a href="{{ route('category.show', $category->slug) }}" class="text-primary-300 hover:text-accent transition-colors text-sm">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-6 tracking-wide">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-primary-300 text-sm">
                        <svg class="w-5 h-5 text-accent mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ $settings['address'] ?? 'Jl. Raya Banyuwangi No. 123, Kecamatan Genteng, Kabupaten Banyuwangi, Jawa Timur 68465' }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-primary-300 text-sm">
                        <svg class="w-5 h-5 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        @php $phoneRaw = preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+6281234567890'); @endphp
                        <a href="https://wa.me/{{ ltrim($phoneRaw, '+') }}" target="_blank" class="hover:text-white transition-colors">{{ $settings['phone'] ?? '+62 812-3456-7890' }}</a>
                    </li>
                    <li class="flex items-center gap-3 text-primary-300 text-sm">
                        <svg class="w-5 h-5 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:{{ $settings['email'] ?? 'info@anekajaya.my.id' }}" class="hover:text-white transition-colors">{{ $settings['email'] ?? 'info@anekajaya.my.id' }}</a>
                    </li>
                </ul>

                <h3 class="text-white font-semibold text-lg mt-8 mb-4 tracking-wide">Jam Operasional</h3>
                <ul class="space-y-2">
                    <li class="flex justify-between text-primary-300 text-sm">
                        <span>Senin - Sabtu</span>
                        <span class="font-medium text-white">{{ $settings['hours_weekday'] ?? '06.20 - 16.00' }}</span>
                    </li>
                    <li class="flex justify-between text-primary-300 text-sm">
                        <span>Minggu</span>
                        <span class="font-medium text-white">{{ $settings['hours_weekend'] ?? '06.20 - 13.00' }}</span>
                    </li>
                    <li class="flex justify-between text-red-400 text-sm">
                        <span>Tgl Merah / Libur</span>
                        <span class="font-medium text-red-400">{{ $settings['hours_holiday'] ?? 'Tutup / Menyesuaikan' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom -->
        <div class="pt-8 border-t border-primary-900 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex flex-col items-center lg:items-start text-center lg:text-left gap-2.5">
                <p class="text-primary-300 text-sm">
                    &copy; {{ date('Y') }} <span class="font-semibold text-white">{{ $settings['store_name'] ?? 'Toko Bangunan Aneka Jaya' }}</span>. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center flex-wrap justify-center lg:justify-start gap-x-3 gap-y-1 text-xs text-primary-500">
                    <span class="uppercase tracking-wider text-[10px] font-bold text-primary-600">Powered By:</span>
                    <a href="https://iqbaldeveloper.my.id/" target="_blank" class="font-medium text-cyan-400 hover:text-cyan-300 transition-colors">iqbaldeveloper</a>
                    <span class="text-primary-700/50">&bull;</span>
                    <a href="https://hypertechnology.my.id/" target="_blank" class="font-medium text-purple-400 hover:text-purple-300 transition-colors">hypertechnology</a>
                    <span class="text-primary-700/50">&bull;</span>
                    <a href="https://ganeshahost.my.id/" target="_blank" class="font-medium text-amber-400 hover:text-amber-300 transition-colors">ganeshahost</a>
                </div>
            </div>
            
            <div class="flex space-x-6 text-sm font-medium text-primary-400 bg-primary-900/50 px-6 py-3 rounded-full border border-primary-800/50">
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>
