@extends('layouts.admin')

@section('title', 'Kritik & Saran')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Kritik & Saran Masuk</h1>
    <p class="text-gray-600 mt-1">Daftar semua masukan dan saran dari pengunjung website.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="py-4 px-6 font-semibold text-sm text-gray-600 w-16">No</th>
                    <th class="py-4 px-6 font-semibold text-sm text-gray-600">Pengirim</th>
                    <th class="py-4 px-6 font-semibold text-sm text-gray-600">Kontak</th>
                    <th class="py-4 px-6 font-semibold text-sm text-gray-600">Jenis Masukan</th>
                    <th class="py-4 px-6 font-semibold text-sm text-gray-600 w-1/3">Pesan</th>
                    <th class="py-4 px-6 font-semibold text-sm text-gray-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($feedbacks as $feedback)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="py-4 px-6 text-sm text-gray-500">{{ $loop->iteration + $feedbacks->firstItem() - 1 }}</td>
                    <td class="py-4 px-6">
                        <div class="font-medium text-gray-900">{{ $feedback->name }}</div>
                        <div class="text-xs text-gray-500 mt-0.5">{{ $feedback->created_at->translatedFormat('d M Y, H:i') }}</div>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $feedback->contact }}</td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700">
                            {{ $feedback->type }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600">
                        <p class="line-clamp-3">{{ $feedback->message }}</p>
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        @php
                            $contact = preg_replace('/[^a-zA-Z0-9@.]/', '', $feedback->contact);
                            $isEmail = filter_var($contact, FILTER_VALIDATE_EMAIL);
                            $waPhone = preg_replace('/[^0-9]/', '', $feedback->contact);
                            if (substr($waPhone, 0, 1) === '0') {
                                $waPhone = '62' . substr($waPhone, 1);
                            }
                        @endphp
                        
                        @if($isEmail)
                            <a href="mailto:{{ $contact }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 transition-colors" title="Balas via Email">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </a>
                        @else
                            <a href="https://wa.me/{{ $waPhone }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-green-500 hover:bg-green-50 transition-colors" title="Balas via WhatsApp">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </a>
                        @endif

                        <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus masukan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 px-6 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p class="text-base font-medium">Belum ada kritik & saran</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $feedbacks->links() }}
    </div>
</div>
@endsection
