@extends('layouts.admin')

@section('title', isset($seoPage) ? 'Edit SEO Page' : 'Tambah SEO Page')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ isset($seoPage) ? 'Edit SEO Page' : 'Tambah SEO Page' }}</h2>
    </div>
    <a href="{{ route('admin.seo-pages.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
    <form action="{{ isset($seoPage) ? route('admin.seo-pages.update', $seoPage->id) : route('admin.seo-pages.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @if(isset($seoPage))
            @method('PUT')
        @endif

        <div>
            <label for="url" class="block text-sm font-semibold text-gray-700 mb-1">URL Halaman <span class="text-red-500">*</span></label>
            <input type="text" name="url" id="url" value="{{ old('url', $seoPage->url ?? '') }}" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                   placeholder="Contoh: /tentang-kami">
            @error('url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="meta_title" class="block text-sm font-semibold text-gray-700 mb-1">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $seoPage->meta_title ?? '') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                   placeholder="Masukkan meta title untuk SEO">
            @error('meta_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="meta_description" class="block text-sm font-semibold text-gray-700 mb-1">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="3" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                      placeholder="Masukkan meta description untuk SEO">{{ old('meta_description', $seoPage->meta_description ?? '') }}</textarea>
            @error('meta_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors">
                {{ isset($seoPage) ? 'Simpan Perubahan' : 'Tambah SEO Page' }}
            </button>
        </div>
    </form>
</div>
@endsection
