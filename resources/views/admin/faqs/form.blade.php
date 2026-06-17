@extends('layouts.admin')

@section('title', isset($faq) ? 'Edit FAQ' : 'Tambah FAQ')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ isset($faq) ? 'Edit FAQ' : 'Tambah FAQ' }}</h2>
    </div>
    <a href="{{ route('admin.faqs.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
    <form action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @if(isset($faq))
            @method('PUT')
        @endif

        <div>
            <label for="question" class="block text-sm font-semibold text-gray-700 mb-1">Pertanyaan <span class="text-red-500">*</span></label>
            <input type="text" name="question" id="question" value="{{ old('question', $faq->question ?? '') }}" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                   placeholder="Masukkan pertanyaan">
            @error('question') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="answer" class="block text-sm font-semibold text-gray-700 mb-1">Jawaban <span class="text-red-500">*</span></label>
            <textarea name="answer" id="answer" rows="5" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                      placeholder="Masukkan jawaban dari pertanyaan di atas">{{ old('answer', $faq->answer ?? '') }}</textarea>
            @error('answer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1" 
                   {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}
                   class="h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
            <label for="is_active" class="ml-2 block text-sm text-gray-700 font-medium">
                Aktifkan FAQ ini
            </label>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors">
                {{ isset($faq) ? 'Simpan Perubahan' : 'Tambah FAQ' }}
            </button>
        </div>
    </form>
</div>
@endsection
