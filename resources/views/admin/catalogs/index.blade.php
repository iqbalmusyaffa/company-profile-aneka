@extends('layouts.admin')

@section('title', 'Manajemen Katalog PDF')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Katalog PDF</h1>
        <p class="text-gray-600 text-sm mt-1">Kelola file katalog PDF untuk diunduh pengunjung.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.catalogs.create') }}" class="bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-primary-500/30 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Katalog
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-semibold">Nama Katalog</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Kategori</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Tanggal Berlaku</th>
                    <th scope="col" class="px-6 py-4 font-semibold">File PDF</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-center">Status Aktif</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($catalogs as $catalog)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $catalog->title }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($catalog->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md font-medium bg-primary-50 text-primary-700 text-xs border border-primary-100">
                                {{ $catalog->category }}
                            </span>
                        @else
                            <span class="text-gray-400 italic text-xs">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $catalog->publish_date ? $catalog->publish_date->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($catalog->hasMedia('catalogs'))
                            <a href="{{ $catalog->getFirstMediaUrl('catalogs') }}" target="_blank" class="text-primary-600 hover:text-primary-800 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Lihat PDF
                            </a>
                        @else
                            <span class="text-gray-400 italic">Belum ada file</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($catalog->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-gray-400 rounded-full"></span>
                                Tidak Aktif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.catalogs.edit', $catalog->id) }}" class="p-2 text-gray-500 hover:text-primary-600 bg-gray-50 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.catalogs.destroy', $catalog->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus katalog ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-500 hover:text-red-600 bg-gray-50 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p class="text-lg font-medium text-gray-900 mb-1">Belum ada katalog PDF</p>
                        <p class="text-sm">Mulai tambahkan katalog pertama Anda.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($catalogs->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $catalogs->links() }}
    </div>
    @endif
</div>
@endsection
