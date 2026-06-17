@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Katalog Produk</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola semua material bangunan dan inventaris toko Anda.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <button type="button" onclick="document.getElementById('importModal').classList.remove('hidden')" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold py-2.5 px-5 rounded-xl border border-gray-200 shadow-sm transition-all flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            Import
        </button>
        <a href="{{ route('admin.products.export.excel') }}" onclick="const url = new URL(this.href); url.searchParams.set('tz', Intl.DateTimeFormat().resolvedOptions().timeZone); this.href = url.toString();" target="_blank" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold py-2.5 px-5 rounded-xl border border-gray-200 shadow-sm transition-all flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export
        </a>
        <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-primary-500/30 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Produk
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 bg-green-50 text-green-700 p-4 rounded-2xl border border-green-100 flex items-center">
    <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 bg-red-50 text-red-700 p-4 rounded-2xl border border-red-100 flex items-center">
    <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    {{ session('error') }}
</div>
@endif

<!-- Modal Import -->
<div id="importModal" class="hidden fixed inset-0 bg-gray-900/60 backdrop-blur-sm overflow-y-auto h-full w-full z-50 transition-all">
    <div class="relative top-20 mx-auto p-8 border-0 w-[28rem] shadow-2xl rounded-3xl bg-white">
        <div class="mt-2">
            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Import Data Produk</h3>
            <p class="text-sm text-gray-500 mb-6">Unggah file Excel Anda. Pastikan format kolom sesuai dengan template standar kami.</p>
            
            <a href="{{ route('admin.products.import.template') }}" class="text-sm text-primary-600 hover:text-primary-800 font-semibold flex items-center mb-6 bg-primary-50 p-3 rounded-xl transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download Template Excel
            </a>

            <form action="{{ route('admin.products.import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih File (.xlsx)</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-2xl cursor-pointer hover:bg-gray-50 hover:border-primary-300 transition-colors bg-white border-gray-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-primary-600">Klik untuk unggah</span> atau seret file ke sini</p>
                            </div>
                            <input type="file" name="file" required class="hidden" accept=".xlsx,.xls,.csv" />
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all">Mulai Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <!-- Filter Bar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex gap-4 flex-1">
            <div class="relative w-full max-w-xs">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Cari produk..." class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-colors">
            </div>
            <select class="border border-gray-200 rounded-xl px-4 py-2 text-sm bg-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors text-gray-700">
                <option>Semua Kategori</option>
            </select>
        </div>
        <div class="text-sm text-gray-500 font-medium">
            Total: {{ $products->count() }} Produk
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Produk</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori/Merek</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga & Stok</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50/80 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-14 w-14 flex-shrink-0">
                                @if($product->hasMedia('products'))
                                    <img class="h-14 w-14 rounded-xl object-cover border border-gray-200 shadow-sm" src="{{ $product->getFirstMediaUrl('products') }}" alt="">
                                @else
                                    <div class="h-14 w-14 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 max-w-[200px]">
                                <div class="text-sm font-bold text-gray-900 group-hover:text-primary-600 transition-colors truncate" title="{{ $product->name }}">{{ $product->name }}</div>
                                <div class="text-xs text-gray-500 mt-1 font-mono bg-gray-100 px-2 py-0.5 rounded inline-block">SKU: {{ $product->sku ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-sm text-gray-900 font-semibold">{{ $product->category->name ?? 'Tanpa Kategori' }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $product->brand->name ?? 'Tanpa Merek' }}</div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-sm font-bold text-primary-700">Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs font-medium text-gray-500">/{{ $product->unit }}</span></div>
                        <div class="text-xs mt-1">
                            <span class="text-gray-500">Stok:</span> 
                            <span class="{{ $product->stock > 10 ? 'text-green-600 font-semibold' : 'text-red-600 font-bold' }}">{{ $product->stock }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex flex-col gap-2 items-start">
                            @if($product->is_active)
                                <span class="px-3 py-1 inline-flex text-xs leading-tight font-bold rounded-full bg-green-50 text-green-700 border border-green-200">Aktif</span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-tight font-bold rounded-full bg-red-50 text-red-700 border border-red-200">Draft</span>
                            @endif
                            @if($product->is_featured)
                                <span class="px-3 py-1 inline-flex text-xs leading-tight font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-200">Unggulan</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-xl transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini secara permanen?');">
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
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada produk</h3>
                        <p class="text-gray-500 text-sm">Tambahkan produk pertama Anda untuk mulai berjualan.</p>
                        <a href="{{ route('admin.products.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                            Tambah Produk
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $products->links() }}
    </div>
</div>
@endsection

