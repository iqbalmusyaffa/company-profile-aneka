@extends('layouts.admin')

@section('title', isset($gallery) ? 'Edit Galeri' : 'Tambah Galeri')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ isset($gallery) ? 'Edit Galeri' : 'Tambah Galeri' }}</h2>
    </div>
    <a href="{{ route('admin.galleries.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
    <form action="{{ isset($gallery) ? route('admin.galleries.update', $gallery->id) : route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        @if(isset($gallery))
            @method('PUT')
        @endif

        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Galeri <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $gallery->title ?? '') }}" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                   placeholder="Contoh: Proyek Pembangunan Rumah Budi">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="3" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                      placeholder="Masukkan deskripsi galeri (opsional)">{{ old('description', $gallery->description ?? '') }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Gambar Galeri {!! !isset($gallery) ? '<span class="text-red-500">*</span>' : '' !!}</label>
            @if(isset($gallery) && $gallery->hasMedia('galleries'))
                <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl flex justify-center items-center relative group overflow-hidden">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm z-10">
                        <span class="text-white text-xs font-bold px-3 py-1 bg-black/50 rounded-full">Gambar Saat Ini</span>
                    </div>
                    <img src="{{ $gallery->getFirstMediaUrl('galleries') }}" alt="Current Image" class="h-32 object-contain relative z-0">
                </div>
            @endif
            <div class="relative border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary-500 hover:bg-primary-50 transition-all group bg-white">
                <div class="px-6 py-8 flex flex-col items-center justify-center text-center">
                    <div class="w-12 h-12 bg-gray-100 text-gray-400 group-hover:bg-primary-100 group-hover:text-primary-600 rounded-full flex items-center justify-center mb-3 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <p class="text-sm font-bold text-gray-700 group-hover:text-primary-700 mb-1">Pilih File Gambar</p>
                    <p class="text-xs text-gray-500">atau seret dan lepas ke area ini</p>
                    <p class="text-xs text-gray-400 mt-3 font-medium bg-gray-100 px-3 py-1 rounded-full group-hover:bg-primary-100 group-hover:text-primary-600">JPG, PNG (Maks. 2MB)</p>
                </div>
                <input type="file" name="image" id="image" accept="image/*" {{ !isset($gallery) ? 'required' : '' }} class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="if(this.files[0] && this.files[0].size > 2097152) { alert('Ukuran file maksimal adalah 2MB!'); this.value = ''; this.parentElement.querySelector('p.font-bold').innerText = 'Pilih File Gambar'; } else { this.parentElement.querySelector('p.font-bold').innerText = this.files[0] ? this.files[0].name : 'Pilih File Gambar'; }">
            </div>
            @error('image') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors">
                {{ isset($gallery) ? 'Simpan Perubahan' : 'Tambah Galeri' }}
            </button>
        </div>
    </form>
</div>
@endsection
