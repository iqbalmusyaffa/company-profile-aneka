@extends('layouts.admin')

@section('title', 'Referensi Warna Tema')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Katalog Referensi Warna</h2>
    <p class="text-gray-500 text-sm mt-1">Daftar kombinasi warna gradien estetik yang bisa Anda *copy-paste* ke bagian "Web Settings" -> "Teks Judul Utama".</p>
</div>

<div class="bg-blue-50 text-blue-800 p-5 rounded-2xl mb-8 flex gap-4 border border-blue-100 shadow-sm">
    <div class="mt-1 flex-shrink-0">
        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <div>
        <h4 class="font-bold text-lg mb-2">Cara Menggunakan Referensi Ini:</h4>
        <ol class="list-decimal list-inside space-y-1 text-sm">
            <li>Pilih salah satu warna yang Anda sukai di bawah ini.</li>
            <li>Klik tombol <strong>"Salin Kode"</strong> pada warna pilihan Anda.</li>
            <li>Buka halaman <a href="{{ route('admin.settings.index') }}" class="font-bold text-blue-600 hover:underline">Web Settings</a>.</li>
            <li>Di kolom <strong>Teks Judul Utama</strong>, *paste* (tempel) kode yang baru Anda salin tersebut untuk mengapit teks yang ingin diwarnai, dan tutup dengan <code>&lt;/span&gt;</code>.</li>
            <li>Simpan Web Settings Anda.</li>
        </ol>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Preset 1 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-accent to-yellow-300 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Emas Elegan</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-300"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-300\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 2 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-blue-600 to-cyan-400 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Ocean Blue</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-400"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-400\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 3 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-emerald-600 to-teal-400 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Forest Green</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-400"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-400\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 4 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-purple-600 to-pink-500 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Royal Purple</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-500"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-500\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 5 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-red-600 to-orange-500 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Crimson Fire</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-500"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-500\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>
    
    <!-- Preset 6 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-slate-800 to-slate-400 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Slate Gray</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-slate-400"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-slate-400\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 7 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-orange-500 to-yellow-400 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Sunset Orange</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-yellow-400"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-yellow-400\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 8 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Lavender Dream</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 9 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-fuchsia-600 to-purple-600 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Midnight City</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-600 to-purple-600"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-600 to-purple-600\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 10 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-pink-500 to-rose-400 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Cherry Blossom</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-400"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-400\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 11 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-lime-500 to-green-500 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Fresh Lime</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-500 to-green-500"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-lime-500 to-green-500\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 12 -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-violet-600 to-fuchsia-500 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Cosmic Fusion</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-fuchsia-500"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-fuchsia-500\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 13: Sunset Alam -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-red-500 to-amber-500 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Sunset Alam</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-amber-500"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-amber-500\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 14: Cyberpunk -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-yellow-400 to-fuchsia-600 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Cyberpunk</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-fuchsia-600"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-fuchsia-600\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 15: Elegan Premium -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-primary-700 to-accent flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Elegan Premium</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-700 to-accent"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-primary-700 to-accent\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>

    <!-- Preset 16: Go Green -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
        <div class="h-32 bg-gradient-to-r from-emerald-500 to-lime-400 flex items-center justify-center p-6">
            <h3 class="text-3xl font-extrabold text-white drop-shadow-md">Go Green</h3>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode HTML:</p>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 font-mono text-xs text-gray-800 break-all mb-4">
                &lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-lime-400"&gt;
            </div>
            <button onclick="copyToClipboard('<span class=\'text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-lime-400\'>', this)" class="mt-auto w-full py-2.5 bg-gray-100 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                <span>Salin Kode</span>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            // Ubah teks tombol sementara
            const span = btn.querySelector('span');
            const originalText = span.innerText;
            span.innerText = 'Tersalin!';
            btn.classList.add('bg-green-100', 'text-green-700');
            btn.classList.remove('bg-gray-100', 'text-gray-700');
            
            if (typeof toastr !== 'undefined') {
                toastr.success('Kode kelas berhasil disalin: ' + text);
            }
            
            setTimeout(() => {
                span.innerText = originalText;
                btn.classList.remove('bg-green-100', 'text-green-700');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            }, 2000);
        });
    }
</script>
@endpush
@endsection
