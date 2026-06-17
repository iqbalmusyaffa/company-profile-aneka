@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@push('scripts')
<!-- Quill Theme included stylesheets -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</h2>
    </div>
    <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Kolom Utama -->
        <div class="flex-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Dasar</h3>
                
                <!-- Nama Produk -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                           placeholder="Contoh: Semen Gresik 40Kg PCC">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Merek -->
                    <div>
                        <label for="brand_id" class="block text-sm font-semibold text-gray-700 mb-1">Merek</label>
                        <select name="brand_id" id="brand_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            <option value="">Tanpa Merek</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Deskripsi Produk -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Detail Produk</h3>
                
                <div class="mb-4">
                    <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="short_description" id="short_description" rows="2" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                              placeholder="Ringkasan singkat tentang produk...">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                    @error('short_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Lengkap</label>
                    <!-- Input Hidden for Quill -->
                    <input type="hidden" name="description" id="description_input" value="{{ old('description', $product->description ?? '') }}">
                    <!-- Editor Container -->
                    <div id="editor-container" class="h-64 rounded-b-lg"></div>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Kolom Samping -->
        <div class="w-full lg:w-80 space-y-6">
            
            <!-- Harga & Stok -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Inventaris</h3>
                
                <div class="mb-4">
                    <label for="sku" class="block text-sm font-semibold text-gray-700 mb-1">SKU (Kode Barang)</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                           placeholder="Misal: SG-40-PCC">
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Harga Jual (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" required min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                           placeholder="55000">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="original_price" class="block text-sm font-semibold text-gray-700 mb-1">Harga Coret (Diskon)</label>
                    <input type="number" name="original_price" id="original_price" value="{{ old('original_price', $product->original_price ?? '') }}" min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                           placeholder="60000">
                </div>

                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? 0) }}" required min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                    </div>
                    <div class="w-1/2">
                        <label for="unit" class="block text-sm font-semibold text-gray-700 mb-1">Satuan <span class="text-red-500">*</span></label>
                        <input type="text" name="unit" id="unit" value="{{ old('unit', $product->unit ?? 'Sak') }}" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                    </div>
                </div>
            </div>

            <!-- Media -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Gambar Produk</h3>
                
                @if(isset($product) && $product->hasMedia('products'))
                    <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl flex justify-center items-center relative group overflow-hidden">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm z-10">
                            <span class="text-white text-xs font-bold px-3 py-1 bg-black/50 rounded-full">Gambar Saat Ini</span>
                        </div>
                        <img src="{{ $product->getFirstMediaUrl('products') }}" alt="Current Image" class="w-full rounded-xl border border-gray-200 relative z-0">
                    </div>
                @endif
                <div class="relative border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary-500 hover:bg-primary-50 transition-all group bg-white">
                    <div class="px-6 py-8 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-gray-100 text-gray-400 group-hover:bg-primary-100 group-hover:text-primary-600 rounded-full flex items-center justify-center mb-3 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <p class="text-sm font-bold text-gray-700 group-hover:text-primary-700 mb-1">Pilih File Gambar</p>
                        <p class="text-xs text-gray-500">atau seret dan lepas ke area ini</p>
                        <p class="text-xs text-gray-400 mt-3 font-medium bg-gray-100 px-3 py-1 rounded-full group-hover:bg-primary-100 group-hover:text-primary-600">JPG, PNG (Maks. 5MB)</p>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="if(this.files[0] && this.files[0].size > 5242880) { alert('Ukuran file maksimal adalah 5MB!'); this.value = ''; this.parentElement.querySelector('p.font-bold').innerText = 'Pilih File Gambar'; } else { this.parentElement.querySelector('p.font-bold').innerText = this.files[0] ? this.files[0].name : 'Pilih File Gambar'; }">
                </div>
                @error('image') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Publish -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Status</h3>
                
                <div class="space-y-3 mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                               class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700 font-medium">Aktif / Tersedia</span>
                    </label>
                    
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}
                               class="h-5 w-5 text-amber-500 focus:ring-amber-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700 font-medium">Jadikan Produk Unggulan</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition-colors flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    {{ isset($product) ? 'Simpan Perubahan' : 'Terbitkan Produk' }}
                </button>
            </div>

        </div>
    </div>
</form>

@endsection

@push('scripts')
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        // Load existing content
        var descInput = document.getElementById('description_input');
        if (descInput.value) {
            quill.root.innerHTML = descInput.value;
        }

        // On form submit, populate the hidden input with HTML content
        var form = document.querySelector('form');
        form.onsubmit = function() {
            descInput.value = quill.root.innerHTML;
        };
    });
</script>
@endpush
