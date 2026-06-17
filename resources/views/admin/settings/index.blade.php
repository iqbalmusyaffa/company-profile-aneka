@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pengaturan Toko</h2>
    <p class="text-gray-500 text-sm mt-1">Kelola informasi kontak, alamat, sosial media, dan identitas toko bangunan Anda.</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Kolom Utama -->
        <div class="flex-1 space-y-8">
            
            <!-- Profil Toko -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                    <svg class="w-32 h-32 text-primary-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    Profil Toko
                </h3>
                
                <div class="space-y-5 relative z-10">
                    <div>
                        <label for="store_name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Toko</label>
                        <input type="text" name="store_name" id="store_name" value="{{ old('store_name', $settings['store_name'] ?? 'Toko Bangunan Aneka Jaya') }}" 
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                    </div>

                    <div>
                        <label for="store_description" class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi Singkat (SEO Meta Description)</label>
                        <textarea name="store_description" id="store_description" rows="3" 
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">{{ old('store_description', $settings['store_description'] ?? 'Toko material bahan bangunan terlengkap, termurah, dan terpercaya.') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-3">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Logo Website (Navbar)</label>
                            @if(isset($settings['site_logo']) && $settings['site_logo'])
                                <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl flex justify-center items-center relative group overflow-hidden">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm z-10">
                                        <span class="text-white text-xs font-bold px-3 py-1 bg-black/50 rounded-full">Logo Saat Ini</span>
                                    </div>
                                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="max-h-20 max-w-full object-contain relative z-0">
                                </div>
                            @endif
                            <div class="relative border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary-500 hover:bg-primary-50 transition-all group bg-white">
                                <div class="px-6 py-8 flex flex-col items-center justify-center text-center">
                                    <div class="w-12 h-12 bg-gray-100 text-gray-400 group-hover:bg-primary-100 group-hover:text-primary-600 rounded-full flex items-center justify-center mb-3 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-700 group-hover:text-primary-700 mb-1">Pilih File Logo</p>
                                    <p class="text-xs text-gray-500">atau seret dan lepas ke area ini</p>
                                    <p class="text-xs text-gray-400 mt-3 font-medium bg-gray-100 px-3 py-1 rounded-full group-hover:bg-primary-100 group-hover:text-primary-600">PNG, JPG (Maks. 2MB)</p>
                                </div>
                                <input type="file" name="site_logo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="if(this.files[0] && this.files[0].size > 2097152) { alert('Ukuran file maksimal adalah 2MB!'); this.value = ''; this.parentElement.querySelector('p.font-bold').innerText = 'Pilih File Logo'; } else { this.parentElement.querySelector('p.font-bold').innerText = this.files[0] ? this.files[0].name : 'Pilih File Logo'; }">
                            </div>
                            @error('site_logo')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Favicon (Ikon Tab Browser)</label>
                            @if(isset($settings['site_favicon']) && $settings['site_favicon'])
                                <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl flex justify-center items-center relative group overflow-hidden">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm z-10">
                                        <span class="text-white text-xs font-bold px-3 py-1 bg-black/50 rounded-full">Favicon Saat Ini</span>
                                    </div>
                                    <img src="{{ asset('storage/' . $settings['site_favicon']) }}" alt="Favicon" class="w-12 h-12 object-contain relative z-0">
                                </div>
                            @endif
                            <div class="relative border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary-500 hover:bg-primary-50 transition-all group bg-white">
                                <div class="px-6 py-8 flex flex-col items-center justify-center text-center">
                                    <div class="w-12 h-12 bg-gray-100 text-gray-400 group-hover:bg-primary-100 group-hover:text-primary-600 rounded-full flex items-center justify-center mb-3 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-700 group-hover:text-primary-700 mb-1">Pilih File Favicon</p>
                                    <p class="text-xs text-gray-500">atau seret dan lepas ke area ini</p>
                                    <p class="text-xs text-gray-400 mt-3 font-medium bg-gray-100 px-3 py-1 rounded-full group-hover:bg-primary-100 group-hover:text-primary-600">PNG, ICO (Maks. 2MB)</p>
                                </div>
                                <input type="file" name="site_favicon" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="if(this.files[0] && this.files[0].size > 2097152) { alert('Ukuran file maksimal adalah 2MB!'); this.value = ''; this.parentElement.querySelector('p.font-bold').innerText = 'Pilih File Favicon'; } else { this.parentElement.querySelector('p.font-bold').innerText = this.files[0] ? this.files[0].name : 'Pilih File Favicon'; }">
                            </div>
                            @error('site_favicon')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-bold text-gray-700 mb-3">Dokumen Profil Perusahaan (Tentang Kami)</label>
                        @if(isset($settings['company_profile']) && $settings['company_profile'])
                            <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">File Profil Saat Ini</p>
                                        <a href="{{ asset('storage/' . $settings['company_profile']) }}" target="_blank" class="text-xs text-primary-600 hover:underline">Lihat File</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="relative border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary-500 hover:bg-primary-50 transition-all group bg-white">
                            <div class="px-6 py-8 flex flex-col items-center justify-center text-center">
                                <div class="w-12 h-12 bg-gray-100 text-gray-400 group-hover:bg-primary-100 group-hover:text-primary-600 rounded-full flex items-center justify-center mb-3 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </div>
                                <p class="text-sm font-bold text-gray-700 group-hover:text-primary-700 mb-1">Pilih File Profil</p>
                                <p class="text-xs text-gray-500">atau seret dan lepas ke area ini</p>
                                <p class="text-xs text-gray-400 mt-3 font-medium bg-gray-100 px-3 py-1 rounded-full group-hover:bg-primary-100 group-hover:text-primary-600">PDF, PNG, JPG (Maks. 5MB)</p>
                            </div>
                            <input type="file" name="company_profile" accept=".pdf,.png,.jpg,.jpeg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="if(this.files[0] && this.files[0].size > 5242880) { alert('Ukuran file maksimal adalah 5MB!'); this.value = ''; this.parentElement.querySelector('p.font-bold').innerText = 'Pilih File Profil'; } else { this.parentElement.querySelector('p.font-bold').innerText = this.files[0] ? this.files[0].name : 'Pilih File Profil'; }">
                        </div>
                        @error('company_profile')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Teks Halaman Depan (Hero Section) -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                    <svg class="w-32 h-32 text-primary-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    Teks Halaman Depan (Hero Section)
                </h3>
                
                <div class="space-y-5 relative z-10">
                    <div>
                        <label for="hero_subtitle" class="block text-sm font-bold text-gray-700 mb-1.5">Teks Sub-judul (Paling Atas)</label>
                        <input type="text" name="hero_subtitle" id="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Toko Bangunan Terlengkap di Banyuwangi') }}" 
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                    </div>
                    <div>
                        <label for="hero_title" class="block text-sm font-bold text-gray-700 mb-1.5">Teks Judul Utama (Format HTML / Teks biasa)</label>
                        <div class="bg-blue-50 text-blue-800 text-xs p-3 rounded-lg mb-3 flex gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Gunakan <code>&lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-300"&gt;</code> untuk teks yang ditekankan dengan gradien warna.</span>
                        </div>
                        <textarea name="hero_title" id="hero_title" rows="2" 
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-mono text-sm focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">{{ old('hero_title', $settings['hero_title'] ?? 'Bangun <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-300">Rumah Impian Anda</span> dengan Material Berkualitas') }}</textarea>
                    </div>
                    <div>
                        <label for="hero_description" class="block text-sm font-bold text-gray-700 mb-1.5">Teks Deskripsi</label>
                        <textarea name="hero_description" id="hero_description" rows="3" 
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">{{ old('hero_description', $settings['hero_description'] ?? 'Menyediakan segala kebutuhan bahan bangunan dari fondasi hingga atap. Harga kompetitif, pelayanan ramah, dan kualitas terjamin.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Kontak & Alamat -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                    <svg class="w-32 h-32 text-primary-500" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    Kontak & Alamat
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5 relative z-10">
                    <div>
                        <label for="phone" class="block text-sm font-bold text-gray-700 mb-1.5">Nomor Telepon (WhatsApp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $settings['phone'] ?? '+62 812-3456-7890') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email', $settings['email'] ?? 'info@anekajaya.my.id') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5 relative z-10">
                    <div>
                        <label for="hours_weekday" class="block text-sm font-bold text-gray-700 mb-1.5">Jam Buka (Senin - Sabtu)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <input type="text" name="hours_weekday" id="hours_weekday" value="{{ old('hours_weekday', $settings['hours_weekday'] ?? '06.20 - 16.00') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="hours_weekend" class="block text-sm font-bold text-gray-700 mb-1.5">Jam Buka (Minggu)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <input type="text" name="hours_weekend" id="hours_weekend" value="{{ old('hours_weekend', $settings['hours_weekend'] ?? '06.20 - 13.00') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="hours_holiday" class="block text-sm font-bold text-gray-700 mb-1.5">Jam Buka (Tgl Merah/Libur)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <input type="text" name="hours_holiday" id="hours_holiday" value="{{ old('hours_holiday', $settings['hours_holiday'] ?? 'Tutup / Menyesuaikan') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all" placeholder="Tutup / 08.00 - 12.00">
                        </div>
                    </div>
                </div>

                <div class="mb-5 relative z-10">
                    <label for="address" class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="2" 
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">{{ old('address', $settings['address'] ?? 'Jl. Raya Bangunan No. 123, Jakarta') }}</textarea>
                </div>

                <div class="relative z-10">
                    <label for="google_map" class="block text-sm font-bold text-gray-700 mb-1.5">Link Google Maps</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text" name="google_map" id="google_map" value="{{ old('google_map', $settings['google_map'] ?? '') }}" 
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Samping -->
        <div class="w-full lg:w-96 space-y-8">
            
            <!-- Sosial Media -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </div>
                    Sosial Media
                </h3>
                
                <div class="space-y-5">
                    <div>
                        <label for="instagram" class="block text-sm font-bold text-gray-700 mb-1.5">Instagram URL</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 font-bold text-lg">IG</span>
                            </div>
                            <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $settings['instagram'] ?? 'https://instagram.com/') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="facebook" class="block text-sm font-bold text-gray-700 mb-1.5">Facebook URL</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 font-bold text-lg">FB</span>
                            </div>
                            <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $settings['facebook'] ?? 'https://facebook.com/') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="tiktok" class="block text-sm font-bold text-gray-700 mb-1.5">TikTok URL</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 font-bold text-lg">TK</span>
                            </div>
                            <input type="url" name="tiktok" id="tiktok" value="{{ old('tiktok', $settings['tiktok'] ?? 'https://tiktok.com/') }}" 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simpan -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <div class="mb-4 text-sm text-gray-500 text-center">Pastikan semua data sudah benar sebelum menyimpan perubahan.</div>
                <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 text-white font-bold py-3.5 px-4 rounded-xl transition-all flex justify-center items-center gap-2 shadow-lg shadow-primary-500/30 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Simpan Pengaturan
                </button>
            </div>
            
        </div>
    </div>
</form>
@endsection
