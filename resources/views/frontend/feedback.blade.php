@extends('layouts.app')

@section('title', 'Kritik dan Saran - ' . config('app.name', 'Toko Bangunan Aneka Jaya'))

@section('content')
<div class="bg-gray-50 py-16 min-h-screen flex items-center justify-center">
    <div class="max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
            <div class="text-center mb-10">
                <div class="w-16 h-16 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-primary-950 mb-4 tracking-tight">Kritik & Saran</h1>
                <p class="text-gray-600">Masukan Anda sangat berarti bagi kami untuk terus meningkatkan kualitas pelayanan dan kelengkapan produk di Toko Bangunan Aneka Jaya.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('feedback.store') }}" method="POST" class="space-y-6">
                @csrf
                @honeypot
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Anda <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Contoh: Budi Santoso" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                    </div>
                    
                    <div>
                        <label for="contact" class="block text-sm font-bold text-gray-700 mb-1.5">Email / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="contact" id="contact" placeholder="Email atau No. WA Anda" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                    </div>
                </div>
                
                <div>
                    <label for="type" class="block text-sm font-bold text-gray-700 mb-1.5">Jenis Masukan <span class="text-red-500">*</span></label>
                    <select name="type" id="type" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm appearance-none">
                        <option value="" disabled selected>Pilih jenis masukan...</option>
                        <option value="Kritik Pelayanan">Kritik Pelayanan</option>
                        <option value="Saran Produk Baru">Saran Kelengkapan Produk / Barang Baru</option>
                        <option value="Saran Website">Saran Tampilan/Fitur Website</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="message" class="block text-sm font-bold text-gray-700 mb-1.5">Detail Kritik / Saran <span class="text-red-500">*</span></label>
                    <textarea name="message" id="message" rows="5" placeholder="Tuliskan kritik atau saran Anda di sini..." required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm"></textarea>
                </div>
                
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-primary-500/30 flex items-center justify-center gap-2">
                    Kirim Masukan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600 font-medium text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
