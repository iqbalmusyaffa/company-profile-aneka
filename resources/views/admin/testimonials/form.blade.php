@extends('layouts.admin')

@section('title', isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni' }}</h2>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
    <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @if(isset($testimonial))
            @method('PUT')
        @endif

        <div>
            <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Pelanggan <span class="text-red-500">*</span></label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $testimonial->customer_name ?? '') }}" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                   placeholder="Masukkan nama pelanggan">
            @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="rating" class="block text-sm font-semibold text-gray-700 mb-1">Rating <span class="text-red-500">*</span></label>
            <select name="rating" id="rating" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                        {{ $i }} Bintang
                    </option>
                @endfor
            </select>
            @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="comment" class="block text-sm font-semibold text-gray-700 mb-1">Komentar / Ulasan <span class="text-red-500">*</span></label>
            <textarea name="comment" id="comment" rows="4" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                      placeholder="Masukkan komentar pelanggan">{{ old('comment', $testimonial->comment ?? '') }}</textarea>
            @error('comment') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors">
                {{ isset($testimonial) ? 'Simpan Perubahan' : 'Tambah Testimoni' }}
            </button>
        </div>
    </form>
</div>
@endsection
