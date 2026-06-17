@extends('layouts.admin')

@section('title', 'Manajemen Promo')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Promo & Penawaran</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola banner promo, diskon, dan penawaran spesial untuk pelanggan.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.promotions.create') }}" class="bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-primary-500/30 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Promo
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-wrap gap-4 items-center justify-between">
        <div class="text-sm text-gray-500 font-medium">
            Total: {{ $promotions->count() }} Promo
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-16">No</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Judul Promo</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Periode</th>
                    <th scope="col" class="px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($promotions as $promotion)
                <tr class="hover:bg-gray-50/80 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-500 font-medium">
                        {{ $promotions->firstItem() + $loop->index }}
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($promotion->hasMedia('promotions'))
                                <img class="h-16 w-24 rounded-xl object-cover border border-gray-200 shadow-sm" src="{{ $promotion->getFirstMediaUrl('promotions') }}" alt="">
                            @else
                                <div class="h-16 w-24 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="ml-5">
                                <div class="text-sm font-bold text-gray-900 group-hover:text-primary-600 transition-colors">{{ $promotion->title }}</div>
                                <div class="text-xs text-gray-500 mt-1 font-mono bg-gray-100 px-2 py-0.5 rounded inline-block">Slug: {{ $promotion->slug }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-medium text-gray-700">
                                @if($promotion->start_date && $promotion->end_date)
                                    {{ $promotion->start_date->format('d M Y') }} - {{ $promotion->end_date->format('d M Y') }}
                                @else
                                    Selamanya
                                @endif
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.promotions.edit', $promotion->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-xl transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.promotions.destroy', $promotion->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-xl transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada promo</h3>
                        <p class="text-gray-500 text-sm">Tambahkan promo pertama Anda untuk menarik pelanggan.</p>
                        <a href="{{ route('admin.promotions.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                            Tambah Promo
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $promotions->links() }}
    </div>
</div>
@endsection

