@extends('layouts.admin')

@section('title', isset($post) ? 'Edit Artikel' : 'Tulis Artikel')

@push('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ isset($post) ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h2>
    </div>
    <a href="{{ route('admin.posts.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<form action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Kolom Utama -->
        <div class="flex-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                
                <!-- Judul Artikel -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" required 
                           class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 font-bold"
                           placeholder="Contoh: 5 Tips Memilih Semen Berkualitas untuk Rumah Anda">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-1">Kutipan / Ringkasan (SEO)</label>
                    <textarea name="excerpt" id="excerpt" rows="2" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                              placeholder="Ringkasan singkat yang akan muncul di Google dan daftar blog...">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                </div>

                <!-- Konten -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-1">Isi Artikel <span class="text-red-500">*</span></label>
                    <input type="hidden" name="content" id="content_input" value="{{ old('content', $post->content ?? '') }}">
                    <div id="editor-container" class="h-96 rounded-b-lg"></div>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Kolom Samping -->
        <div class="w-full lg:w-80 space-y-6">
            
            <!-- Pengaturan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Pengaturan</h3>
                
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Pilih Kategori...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Media -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Gambar Sampul</h3>
                
                @if(isset($post) && $post->hasMedia('posts'))
                    <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl flex justify-center items-center relative group overflow-hidden">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm z-10">
                            <span class="text-white text-xs font-bold px-3 py-1 bg-black/50 rounded-full">Gambar Saat Ini</span>
                        </div>
                        <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="Cover" class="w-full rounded-xl border border-gray-200 relative z-0">
                    </div>
                @endif
                <div class="relative border-2 border-dashed border-gray-300 rounded-2xl hover:border-emerald-500 hover:bg-emerald-50 transition-all group bg-white">
                    <div class="px-6 py-8 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-gray-100 text-gray-400 group-hover:bg-emerald-100 group-hover:text-emerald-600 rounded-full flex items-center justify-center mb-3 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <p class="text-sm font-bold text-gray-700 group-hover:text-emerald-700 mb-1">Pilih File Gambar</p>
                        <p class="text-xs text-gray-500">atau seret dan lepas ke area ini</p>
                        <p class="text-xs text-gray-400 mt-3 font-medium bg-gray-100 px-3 py-1 rounded-full group-hover:bg-emerald-100 group-hover:text-emerald-600">JPG, PNG, WEBP (Maks. 5MB)</p>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="if(this.files[0] && this.files[0].size > 5242880) { alert('Ukuran file maksimal adalah 5MB!'); this.value = ''; this.parentElement.querySelector('p.font-bold').innerText = 'Pilih File Gambar'; } else { this.parentElement.querySelector('p.font-bold').innerText = this.files[0] ? this.files[0].name : 'Pilih File Gambar'; }">
                </div>
                <p class="text-gray-500 text-xs mt-2 text-center">Disarankan rasio 16:9 (Landscape).</p>
                @error('image') <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p> @enderror
            </div>

            <!-- Publish -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Status Publikasi</h3>
                
                <div class="space-y-3 mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published ?? true) ? 'checked' : '' }}
                               class="h-5 w-5 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700 font-medium">Terbitkan Langsung</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-lg transition-colors flex justify-center items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    {{ isset($post) ? 'Perbarui Artikel' : 'Publikasikan' }}
                </button>
            </div>

        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tulis isi artikel blog Anda di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        // Load existing content
        var descInput = document.getElementById('content_input');
        if (descInput.value) {
            quill.root.innerHTML = descInput.value;
        }

        // On form submit, populate the hidden input
        var form = document.querySelector('form');
        form.onsubmit = function() {
            // Check if it's purely empty tags
            if (quill.getText().trim().length === 0 && !quill.root.querySelector('img')) {
                descInput.value = '';
            } else {
                descInput.value = quill.root.innerHTML;
            }
        };
    });
</script>
@endpush
