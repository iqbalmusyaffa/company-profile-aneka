@extends('layouts.app')

@section('title', 'Tentang Kami - ' . config('app.name', 'Toko Bangunan Aneka Jaya'))

@section('content')
<!-- Hero Section -->
<div class="relative bg-primary-900 text-white overflow-hidden py-24 lg:py-32">
    <!-- Background Decoration -->
    <div class="absolute inset-0 z-0 opacity-20">
        <svg class="absolute right-0 top-0 transform translate-x-1/3 -translate-y-1/4 w-full h-full text-white" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <polygon points="50,0 100,0 50,100 0,100" />
        </svg>
        <div class="absolute inset-0 bg-gradient-to-br from-primary-900 via-primary-800 to-transparent"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-primary-800 border border-primary-700 text-primary-200 text-sm font-bold tracking-wider uppercase mb-6 shadow-sm">
            Sejak 1997
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 tracking-tight leading-tight">
            Lebih dari 25 Tahun <br class="hidden md:block" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-300">Membangun Banyuwangi</span>
        </h1>
        <p class="text-lg md:text-xl text-primary-100 max-w-3xl mx-auto font-light leading-relaxed mb-8">
            Mengenal lebih dekat Toko Bangunan Aneka Jaya 1, pionir penyedia material konstruksi berkualitas tinggi dan terpercaya di Kabupaten Banyuwangi.
        </p>
        
        @php
            $companyProfile = \App\Models\Setting::where('key', 'company_profile')->value('value');
        @endphp
        @if($companyProfile)
            <div class="flex justify-center">
                <a href="{{ asset('storage/' . $companyProfile) }}" target="_blank" class="px-8 py-3.5 bg-white text-primary-900 font-bold rounded-xl shadow-lg shadow-black/10 hover:bg-gray-100 transition-all flex items-center gap-2 transform hover:-translate-y-1">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh Profil Perusahaan
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Tabs Content Section using Alpine.js -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20 pb-24" x-data="{ activeTab: 'sejarah' }">
    <!-- Tabs Header -->
    <div class="bg-white rounded-2xl shadow-xl shadow-primary-900/5 p-2 flex flex-col sm:flex-row border border-gray-100 mb-8 overflow-x-auto gap-2">
        <button @click="activeTab = 'sejarah'" 
                class="flex-1 px-6 py-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-3 whitespace-nowrap"
                :class="activeTab === 'sejarah' ? 'bg-primary-50 text-primary-700 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Sejarah Pendirian
        </button>
        <button @click="activeTab = 'peran'" 
                class="flex-1 px-6 py-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-3 whitespace-nowrap"
                :class="activeTab === 'peran' ? 'bg-primary-50 text-primary-700 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            Peran & Kontribusi
        </button>
        <button @click="activeTab = 'layanan'" 
                class="flex-1 px-6 py-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-3 whitespace-nowrap"
                :class="activeTab === 'layanan' ? 'bg-primary-50 text-primary-700 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
            Layanan Terbaik
        </button>
        <button @click="activeTab = 'visimisi'" 
                class="flex-1 px-6 py-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-3 whitespace-nowrap"
                :class="activeTab === 'visimisi' ? 'bg-primary-50 text-primary-700 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            Visi & Misi
        </button>
    </div>

    <!-- Tabs Body -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 right-0 p-8 opacity-5 pointer-events-none">
            <svg class="w-48 h-48 text-primary-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>

        <!-- Sejarah -->
        <div x-show="activeTab === 'sejarah'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="p-8 md:p-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                Perjalanan Awal
            </h2>
            <div class="prose prose-lg prose-primary max-w-none text-gray-600 leading-relaxed">
                <p><strong>Toko Bangunan Aneka Jaya 1</strong> merupakan sebuah usaha yang bergerak di bidang penyediaan bahan bangunan, berdiri kokoh sejak tahun <strong>1997</strong> di Desa Tamanagung, Kecamatan Cluring, Kabupaten Banyuwangi.</p>
                <p>Awal didirikan oleh Bapak <strong>Sudarno Sofii</strong>, toko ini dirancang secara khusus untuk memenuhi kebutuhan masyarakat setempat terhadap bahan dan alat bangunan yang berkualitas tinggi namun tetap terjangkau.</p>
                <p>Dalam perkembangannya seiring kemajuan zaman, kepemilikan toko ini beralih kepada Ibu <strong>Suci Rokhaniah</strong>, yang terus melanjutkan dan menjaga erat komitmen pendiri untuk senantiasa memberikan layanan terbaik serta menjaga kepercayaan kepada seluruh pelanggan setia kami.</p>
            </div>
            
            <div class="mt-10 p-6 bg-gradient-to-r from-primary-50 to-white border border-primary-100 rounded-2xl flex items-center gap-6">
                <div class="text-4xl font-black text-primary-300 italic">"</div>
                <p class="text-lg font-medium text-gray-800 italic">"Komitmen kami sejak 1997 tidak pernah berubah: Kualitas terbaik untuk bangunan terkuat."</p>
            </div>
        </div>

        <!-- Peran -->
        <div x-show="activeTab === 'peran'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="p-8 md:p-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                Fondasi Infrastruktur Daerah
            </h2>
            <div class="prose prose-lg prose-primary max-w-none text-gray-600 leading-relaxed">
                <p>Sebagai salah satu toko bangunan terkemuka yang telah beroperasi lebih dari <strong>25 tahun</strong>, Aneka Jaya 1 memiliki peran penting dan strategis dalam mendukung akselerasi pembangunan infrastruktur di seluruh wilayah Banyuwangi.</p>
                <p>Ketersediaan produk yang super lengkap seperti semen, pasir, besi, cat, hingga perkakas dan alat-alat tukang modern lainnya menjadi bagian esensial untuk memenuhi kebutuhan mulai dari konstruksi perumahan, renovasi ringan, hingga suplai untuk proyek-proyek lokal berskala besar.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-10">
                <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <div class="text-2xl mb-2">🧱</div>
                    <div class="font-bold text-gray-900">Semen & Pasir</div>
                </div>
                <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <div class="text-2xl mb-2">⛓️</div>
                    <div class="font-bold text-gray-900">Besi & Baja</div>
                </div>
                <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <div class="text-2xl mb-2">🎨</div>
                    <div class="font-bold text-gray-900">Cat & Finishing</div>
                </div>
                <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <div class="text-2xl mb-2">🔨</div>
                    <div class="font-bold text-gray-900">Alat Pertukangan</div>
                </div>
            </div>
        </div>

        <!-- Layanan -->
        <div x-show="activeTab === 'layanan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="p-8 md:p-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
                Lebih dari Sekadar Menjual
            </h2>
            <div class="prose prose-lg prose-primary max-w-none text-gray-600 leading-relaxed mb-8">
                <p>Dalam konteks pembangunan daerah, toko ini tidak hanya berfungsi sebagai penyedia kebutuhan material pasif, tetapi juga bertindak proaktif sebagai <strong>katalisator bagi peningkatan kualitas hidup masyarakat</strong> melalui kemudahan akses terhadap bahan bangunan yang mumpuni.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 relative overflow-hidden group hover:border-primary-200 transition-colors">
                    <div class="w-10 h-10 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 text-primary-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Konsultasi Gratis</h3>
                    <p class="text-gray-600 text-sm">Tim ahli kami siap membantu Anda menghitung RAB dan memilih material yang paling tepat guna sesuai anggaran Anda.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 relative overflow-hidden group hover:border-primary-200 transition-colors">
                    <div class="w-10 h-10 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 text-primary-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600 text-sm">Pelayanan tambahan pengiriman barang langsung ke lokasi proyek menunjukkan pendekatan komprehensif kami dalam memenuhi pesanan pelanggan dengan sigap.</p>
                </div>
            </div>
        </div>

        <!-- Visi & Misi -->
        <div x-show="activeTab === 'visimisi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="p-8 md:p-12">
            
            <!-- Visi -->
            <div class="mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-4">
                    <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    Visi Perusahaan
                </h2>
                <div class="p-6 md:p-8 bg-gradient-to-br from-primary-600 to-primary-800 text-white rounded-3xl shadow-lg relative overflow-hidden">
                    <svg class="absolute top-0 right-0 transform translate-x-1/4 -translate-y-1/4 w-32 h-32 text-primary-500 opacity-30" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                    <p class="text-xl md:text-2xl font-light leading-relaxed relative z-10">
                        "Menjadi toko bangunan terkemuka di Banyuwangi yang dikenal karena kualitas produk, kepercayaan pelanggan, dan kontribusi terhadap pembangunan infrastruktur lokal."
                    </p>
                </div>
            </div>

            <!-- Misi -->
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-4">
                    <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    Misi Kami
                </h2>
                <div class="space-y-4">
                    <div class="flex gap-4 p-5 bg-white border border-gray-100 rounded-2xl hover:border-primary-300 hover:shadow-md transition-all">
                        <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold shrink-0">1</div>
                        <p class="text-gray-700 pt-1">Menyediakan produk bahan bangunan berkualitas tinggi dengan harga yang kompetitif untuk mendukung kebutuhan konstruksi masyarakat.</p>
                    </div>
                    <div class="flex gap-4 p-5 bg-white border border-gray-100 rounded-2xl hover:border-primary-300 hover:shadow-md transition-all">
                        <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold shrink-0">2</div>
                        <p class="text-gray-700 pt-1">Memberikan pelayanan yang ramah, profesional, dan responsif guna menciptakan kepuasan pelanggan.</p>
                    </div>
                    <div class="flex gap-4 p-5 bg-white border border-gray-100 rounded-2xl hover:border-primary-300 hover:shadow-md transition-all">
                        <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold shrink-0">3</div>
                        <p class="text-gray-700 pt-1">Mendukung pembangunan infrastruktur di wilayah Banyuwangi melalui ketersediaan material yang lengkap dan tepat waktu.</p>
                    </div>
                    <div class="flex gap-4 p-5 bg-white border border-gray-100 rounded-2xl hover:border-primary-300 hover:shadow-md transition-all">
                        <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold shrink-0">4</div>
                        <p class="text-gray-700 pt-1">Meningkatkan kepercayaan pelanggan melalui layanan tambahan seperti konsultasi kebutuhan bahan dan pengiriman barang ke lokasi proyek.</p>
                    </div>
                    <div class="flex gap-4 p-5 bg-white border border-gray-100 rounded-2xl hover:border-primary-300 hover:shadow-md transition-all">
                        <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold shrink-0">5</div>
                        <p class="text-gray-700 pt-1">Mengembangkan hubungan yang berkelanjutan dengan pelanggan dan mitra kerja untuk memperluas jangkauan usaha.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="bg-gray-50 border-t border-gray-100 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Siap Membangun Bersama Kami?</h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Percayakan kebutuhan material bangunan Anda pada ahlinya. Hubungi kami sekarang untuk mendapatkan penawaran harga terbaik.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('product.index') }}" class="px-8 py-3.5 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:bg-primary-700 transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Lihat Katalog Produk
            </a>
            <a href="{{ route('contact.index') }}" class="px-8 py-3.5 bg-white text-gray-700 font-bold border border-gray-200 rounded-xl hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
