@extends('layouts.admin')

@section('title', isset($catalog) ? 'Edit Katalog' : 'Tambah Katalog')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">
            {{ isset($catalog) ? 'Edit Katalog' : 'Tambah Katalog Baru' }}
        </h1>
        <p class="text-gray-600 text-sm mt-1">
            {{ isset($catalog) ? 'Perbarui informasi katalog PDF.' : 'Unggah file PDF katalog terbaru Anda.' }}
        </p>
    </div>
    <a href="{{ route('admin.catalogs.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
    <form action="{{ isset($catalog) ? route('admin.catalogs.update', $catalog->id) : route('admin.catalogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($catalog))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Nama Katalog -->
            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Katalog <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $catalog->title ?? '') }}" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-gray-900"
                    placeholder="Contoh: Katalog Bahan Bangunan Juni 2026">
                @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label for="category" class="block text-sm font-bold text-gray-700 mb-1.5">Kategori File</label>
                <input type="text" list="categories_list" name="category" id="category" value="{{ old('category', $catalog->category ?? '') }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-gray-900"
                    placeholder="Contoh: Brosur, Katalog, Laporan">
                <datalist id="categories_list">
                    <option value="Katalog"></option>
                    <option value="Brosur"></option>
                    <option value="Company Profile"></option>
                    <option value="Laporan"></option>
                </datalist>
                <p class="text-xs text-gray-500 mt-1">Ketik baru atau pilih dari daftar.</p>
                @error('category') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Berlaku -->
            <div>
                <label for="publish_date" class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Berlaku</label>
                <input type="date" name="publish_date" id="publish_date" value="{{ old('publish_date', isset($catalog) && $catalog->publish_date ? $catalog->publish_date->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all text-gray-900">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ada tanggal.</p>
                @error('publish_date') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- File Upload PDF -->
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">File PDF Katalog <span class="text-red-500">*</span></label>
            
            <div class="flex items-center justify-center w-full">
                <label for="pdf_file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all group relative overflow-hidden">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4 z-10">
                        <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                        <p class="mb-1 text-sm text-gray-500"><span class="font-bold text-primary-600">Klik untuk unggah PDF</span> atau drag and drop</p>
                        <p class="text-xs text-gray-500">PDF (Maks. 10MB)</p>
                        
                        <div id="file-name-display" class="mt-3 hidden">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="file-name truncate max-w-[200px]"></span>
                            </span>
                        </div>
                    </div>
                    <input id="pdf_file" name="pdf_file" type="file" class="hidden" accept=".pdf" {{ isset($catalog) ? '' : 'required' }} />
                </label>
            </div>
            @error('pdf_file') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
            
            @if(isset($catalog) && $catalog->hasMedia('catalogs'))
                <div class="mt-3 flex items-center gap-2 text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-100">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>File PDF saat ini sudah tersimpan. Unggah file baru hanya jika ingin menggantinya.</span>
                </div>
            @endif
        </div>

        <!-- Status Aktif -->
        <div class="mb-8">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $catalog->is_active ?? true) ? 'checked' : '' }}>
                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary-600"></div>
                <span class="ml-3 text-sm font-bold text-gray-700">Tampilkan di Halaman Utama (Aktif)</span>
            </label>
            <p class="text-xs text-gray-500 mt-1 ml-17">Hanya katalog dengan status Aktif yang akan terlihat oleh pengunjung.</p>
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.catalogs.index') }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-primary-500/30 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Katalog
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Preview file name when selected
    document.getElementById('pdf_file').addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            const fileName = e.target.files[0].name;
            const fileSize = e.target.files[0].size / 1024 / 1024; // in MB
            
            if(fileSize > 10) {
                alert('Ukuran file terlalu besar! Maksimal 10MB.');
                this.value = ''; // Reset
                document.getElementById('file-name-display').classList.add('hidden');
                return;
            }
            
            document.querySelector('.file-name').textContent = fileName;
            document.getElementById('file-name-display').classList.remove('hidden');
        } else {
            document.getElementById('file-name-display').classList.add('hidden');
        }
    });
</script>
@endpush
@endsection
