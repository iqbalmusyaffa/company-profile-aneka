@extends('layouts.admin')

@section('title', 'Manajemen Merek')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Merek Mitra</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola merek produk (supplier) di toko Anda.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.brands.create') }}" class="bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-primary-500/30 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Merek
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-wrap gap-4 items-center justify-between">
        <div class="text-sm text-gray-500 font-medium">
            Total: {{ $brands->count() }} Merek
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-16">No</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Merek</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($brands as $brand)
                <tr class="hover:bg-gray-50/80 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-500 font-medium">
                        {{ $brands->firstItem() + $loop->index }}
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($brand->hasMedia('brands'))
                                <img class="h-12 w-12 rounded-full object-cover border border-gray-200 bg-white p-1 shadow-sm" src="{{ $brand->getFirstMediaUrl('brands') }}" alt="">
                            @else
                                <div class="h-12 w-12 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-bold text-gray-900 group-hover:text-primary-600 transition-colors">{{ $brand->name }}</div>
                                <div class="text-xs text-gray-500 mt-1 font-mono bg-gray-100 px-2 py-0.5 rounded inline-block">Slug: {{ $brand->slug }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <div class="text-sm text-gray-600 line-clamp-2 max-w-xs">{{ $brand->description ?? '-' }}</div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        @if($brand->is_active)
                            <span class="px-3 py-1 inline-flex text-xs leading-tight font-bold rounded-full bg-green-50 text-green-700 border border-green-200">Aktif</span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-tight font-bold rounded-full bg-red-50 text-red-700 border border-red-200">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-xl transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus merek ini?');">
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
                    <td colspan="5" class="px-8 py-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada merek</h3>
                        <p class="text-gray-500 text-sm">Tambahkan merek pertama Anda.</p>
                        <a href="{{ route('admin.brands.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                            Tambah Merek
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $brands->links() }}
    </div>
</div>
@endsection

