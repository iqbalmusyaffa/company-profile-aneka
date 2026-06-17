@extends('layouts.app')

@section('title', 'Kontak Kami - ' . config('app.name', 'Toko Bangunan Aneka Jaya'))

@section('content')
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-primary-950 mb-4 tracking-tight">Hubungi Kami</h1>
            <p class="text-lg text-gray-600">Ada pertanyaan seputar produk atau ingin konsultasi kebutuhan bahan bangunan Anda? Jangan ragu untuk menghubungi kami melalui form di bawah atau kunjungi toko fisik kami.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8">
            <!-- Form & Info -->
            <div class="space-y-8">
                <!-- Info Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Alamat Toko</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $settings['address'] ?? 'Alamat belum diatur' }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm mb-1">Telepon / WhatsApp</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $settings['phone'] ?? 'Belum diatur' }}</p>
                            @if(isset($settings['phone']))
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone']) }}" target="_blank" class="inline-block mt-1 text-xs font-semibold text-green-600 hover:text-green-700">Chat Sekarang &rarr;</a>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow sm:col-span-2">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="w-full">
                            <h3 class="font-bold text-gray-900 text-sm mb-2">Jam Operasional</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1">
                                <div class="flex justify-between border-b border-gray-50 pb-1">
                                    <span class="text-sm text-gray-500">Senin - Sabtu</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $settings['hours_weekday'] ?? '06.20 - 16.00' }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-50 pb-1">
                                    <span class="text-sm text-gray-500">Minggu</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $settings['hours_weekend'] ?? '06.20 - 13.00' }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-50 pb-1 sm:col-span-2">
                                    <span class="text-sm text-red-500 font-medium">Tanggal Merah / Libur Nasional</span>
                                    <span class="text-sm font-bold text-red-600">{{ $settings['hours_holiday'] ?? 'Tutup / Menyesuaikan' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan Langsung</h3>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-medium text-sm">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form id="contactForm" onsubmit="sendToWhatsApp(event)" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-1.5">Email / No WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" name="email" id="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-bold text-gray-700 mb-1.5">Subjek <span class="text-red-500">*</span></label>
                            <input type="text" name="subject" id="subject" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-bold text-gray-700 mb-1.5">Pesan Anda <span class="text-red-500">*</span></label>
                            <textarea name="message" id="message" rows="4" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-green-500/30 flex items-center justify-center gap-2">
                            Kirim ke WhatsApp
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>

                    @php
                        // Format the phone number to standard international WA format (digits only)
                        $waPhone = preg_replace('/[^0-9]/', '', $settings['phone'] ?? '+6281234567890');
                        // Ensure it starts with 62 if it starts with 0
                        if (substr($waPhone, 0, 1) === '0') {
                            $waPhone = '62' . substr($waPhone, 1);
                        }
                    @endphp

                    <script>
                        function sendToWhatsApp(e) {
                            e.preventDefault();
                            
                            const name = document.getElementById('name').value;
                            const email = document.getElementById('email').value;
                            const subject = document.getElementById('subject').value;
                            const message = document.getElementById('message').value;
                            
                            // Phone number from settings
                            const phoneNumber = '{{ $waPhone }}';
                            
                            // Construct the message
                            let text = `Halo *{{ $settings['store_name'] ?? 'Aneka Jaya' }}*, saya ada pertanyaan dari Website.\n\n`;
                            text += `*Nama:* ${name}\n`;
                            text += `*Email/WA:* ${email}\n`;
                            text += `*Subjek:* ${subject}\n\n`;
                            text += `*Pesan:*\n${message}`;
                            
                            // Encode URL
                            const encodedText = encodeURIComponent(text);
                            const waUrl = `https://wa.me/${phoneNumber}?text=${encodedText}`;
                            
                            // Open WhatsApp in new tab
                            window.open(waUrl, '_blank');
                        }
                    </script>
                </div>
            </div>

            <!-- Map Section -->
            <div class="h-full min-h-[400px]">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-2 h-full overflow-hidden flex flex-col">
                    <div class="p-4 sm:p-6 pb-4">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>
                            Lokasi Kami di Peta
                        </h3>
                    </div>
                    
                    <div class="flex-grow rounded-2xl overflow-hidden relative bg-gray-100 border border-gray-100 mx-2 mb-2 group">
                        @if(isset($settings['google_map']) && !empty($settings['google_map']))
                            @if(strpos($settings['google_map'], '<iframe') !== false)
                                <!-- Directly output the iframe code if user pasted raw HTML -->
                                <div class="w-full h-full min-h-[400px] map-container">
                                    {!! $settings['google_map'] !!}
                                </div>
                            @else
                                <!-- Output URL in an iframe -->
                                <iframe src="{{ $settings['google_map'] }}" width="100%" height="100%" style="border:0; min-height:400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            @endif
                        @else
                            <!-- Placeholder if no map is set -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                </div>
                                <h4 class="text-gray-900 font-bold mb-1">Peta Belum Diatur</h4>
                                <p class="text-sm text-gray-500 max-w-xs">Admin dapat mengatur link sematan (embed) Google Maps melalui Dasbor Admin > Web Settings.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    .map-container iframe {
        width: 100% !important;
        height: 100% !important;
        min-height: 400px;
    }
</style>
@endsection
