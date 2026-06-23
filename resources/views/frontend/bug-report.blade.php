@extends('layouts.app')

@section('title', 'Laporan Bug - ' . config('app.name', 'Toko Bangunan Aneka Jaya'))

@section('content')
<div class="bg-gray-50 py-16 min-h-screen flex items-center justify-center">
    <div class="max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
            <div class="text-center mb-10">
                <div class="w-16 h-16 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Laporan Bug / Error</h1>
                <p class="text-gray-600">Menemukan halaman yang error, tombol yang tidak bisa ditekan, atau informasi yang salah? Laporkan kepada kami agar segera diperbaiki.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bug.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @honeypot
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Anda <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Contoh: Budi Santoso" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm">
                    </div>
                    
                    <div>
                        <label for="contact" class="block text-sm font-bold text-gray-700 mb-1.5">Email / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="contact" id="contact" placeholder="Email atau No. WA Anda" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm">
                    </div>
                </div>
                
                <div>
                    <label for="page_url" class="block text-sm font-bold text-gray-700 mb-1.5">Di Halaman Mana Error Terjadi? <span class="text-red-500">*</span></label>
                    <input type="text" name="page_url" id="page_url" placeholder="Contoh: Halaman Keranjang, atau link: www.anekajaya.com/produk/semen" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm">
                </div>

                <div>
                    <label for="message" class="block text-sm font-bold text-gray-700 mb-1.5">Jelaskan Error / Copy Teks Coding <span class="text-red-500">*</span></label>
                    <textarea name="message" id="message" rows="5" placeholder="Contoh: Saat saya menekan tombol Beli Sekarang, halamannya berubah putih blank... Atau Anda bisa paste teks error/coding di sini." required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm font-mono"></textarea>
                </div>
                
                <!-- Upload Area -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Lampirkan Foto / PDF <span class="text-gray-400 font-normal">(Opsional, Maks. 5 MB)</span></label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-red-500 hover:bg-red-50 transition-all relative" id="drop-area">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="attachment" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none px-1">
                                    <span>Pilih file</span>
                                    <input id="attachment" name="attachment" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.pdf,.txt,.zip">
                                </label>
                                <p class="pl-1">atau tarik dan lepas ke sini</p>
                            </div>
                            <p class="text-xs text-gray-500" id="file-name">PNG, JPG, PDF, TXT hingga 5MB</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-red-500/30 flex items-center justify-center gap-2">
                    Kirim Laporan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
            
            <script>
                const fileInput = document.getElementById('attachment');
                const fileNameDisplay = document.getElementById('file-name');
                const dropArea = document.getElementById('drop-area');

                fileInput.addEventListener('change', function(e) {
                    if (e.target.files.length > 0) {
                        const file = e.target.files[0];
                        // Validate size JS side (5MB = 5 * 1024 * 1024)
                        if(file.size > 5242880) {
                            alert('Maaf, ukuran file tidak boleh lebih dari 5 MB.');
                            fileInput.value = '';
                            fileNameDisplay.textContent = 'PNG, JPG, PDF, TXT hingga 5MB';
                            fileNameDisplay.classList.remove('text-green-600', 'font-bold');
                            return;
                        }
                        fileNameDisplay.textContent = 'File terpilih: ' + file.name;
                        fileNameDisplay.classList.add('text-green-600', 'font-bold');
                    } else {
                        fileNameDisplay.textContent = 'PNG, JPG, PDF, TXT hingga 5MB';
                        fileNameDisplay.classList.remove('text-green-600', 'font-bold');
                    }
                });

                // Drag and drop styles
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, preventDefaults, false)
                });
                function preventDefaults (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                ['dragenter', 'dragover'].forEach(eventName => {
                    dropArea.addEventListener(eventName, highlight, false)
                });
                ['dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, unhighlight, false)
                });
                function highlight(e) {
                    dropArea.classList.add('border-red-500', 'bg-red-50');
                }
                function unhighlight(e) {
                    dropArea.classList.remove('border-red-500', 'bg-red-50');
                }
                dropArea.addEventListener('drop', handleDrop, false);
                function handleDrop(e) {
                    let dt = e.dataTransfer;
                    let files = dt.files;
                    if(files.length > 0) {
                        fileInput.files = files;
                        fileInput.dispatchEvent(new Event('change'));
                    }
                }
            </script>
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-red-600 font-medium text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
