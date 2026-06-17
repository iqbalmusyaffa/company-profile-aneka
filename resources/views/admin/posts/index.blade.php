@extends('layouts.admin')

@section('title', 'Artikel Blog')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Artikel Blog</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola konten edukasi, promo, dan berita untuk pelanggan Anda.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.posts.create') }}" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-emerald-500/30 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tulis Artikel Baru
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-wrap gap-4 items-center justify-between">
        <div class="text-sm text-gray-500 font-medium">
            Total: {{ $posts->count() }} Artikel
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Artikel</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50/80 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-16 w-24 flex-shrink-0">
                                @if($post->hasMedia('posts'))
                                    <img class="h-16 w-24 rounded-xl object-cover border border-gray-200 shadow-sm" src="{{ $post->getFirstMediaUrl('posts') }}" alt="">
                                @else
                                    <div class="h-16 w-24 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-5 max-w-[250px] truncate">
                                <div class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors truncate" title="{{ $post->title }}">{{ $post->title }}</div>
                                <div class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $post->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs font-bold">{{ substr($post->author->name ?? 'A', 0, 1) }}</div>
                            <div class="text-sm font-medium text-gray-900">{{ $post->author->name ?? 'Admin' }}</div>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        @if($post->is_published)
                            <span class="px-3 py-1 inline-flex text-xs leading-tight font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">Terbit</span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-tight font-bold rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200">Draft</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-xl transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?');">
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
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada artikel</h3>
                        <p class="text-gray-500 text-sm">Tulis artikel pertama Anda untuk mendatangkan traffic!</p>
                        <a href="{{ route('admin.posts.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 transition-colors">
                            Tulis Artikel Baru
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $posts->links() }}
    </div>
</div>
@endsection

