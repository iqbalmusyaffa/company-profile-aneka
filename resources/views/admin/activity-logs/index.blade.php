@extends('layouts.admin')

@section('title', 'Log Aktivitas')
@section('header', 'Log Aktivitas Sistem')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Riwayat Aktivitas</h2>
        <p class="text-gray-500 mt-1 text-sm">Memantau semua perubahan data yang dilakukan oleh administrator.</p>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pengguna</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Detail Perubahan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($activities as $log)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $log->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($log->event === 'created') bg-green-100 text-green-800 border border-green-200
                            @elseif($log->event === 'updated') bg-blue-100 text-blue-800 border border-blue-200
                            @elseif($log->event === 'deleted') bg-red-100 text-red-800 border border-red-200
                            @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                            {{ ucfirst($log->event) }}
                        </span>
                        <div class="text-xs text-gray-500 mt-1 font-medium">{{ $log->description }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-xs">
                                {{ substr($log->causer->name ?? '?', 0, 2) }}
                            </div>
                            <div class="ml-3 text-sm font-medium text-gray-900">
                                {{ $log->causer->name ?? 'Sistem' }}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($log->properties->has('attributes'))
                            <div x-data="{ expanded: false }">
                                <button @click="expanded = !expanded" class="text-primary-600 hover:text-primary-800 font-medium text-xs flex items-center">
                                    Lihat Detail Perubahan
                                    <svg class="w-4 h-4 ml-1 transform transition-transform" :class="{'rotate-180': expanded}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="expanded" x-collapse class="mt-3 bg-gray-50 p-4 rounded-lg border border-gray-100 font-mono text-xs overflow-x-auto w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl">
                                    @if($log->properties->has('old'))
                                        <div class="text-red-500 mb-2 font-bold">Data Lama:</div>
                                        <pre class="whitespace-pre-wrap text-gray-600 mb-4">{{ json_encode($log->properties['old'], JSON_PRETTY_PRINT) }}</pre>
                                    @endif
                                    <div class="text-green-600 mb-2 font-bold">Data Baru:</div>
                                    <pre class="whitespace-pre-wrap text-gray-600">{{ json_encode($log->properties['attributes'], JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </div>
                        @else
                            <span class="text-gray-400 italic">Tidak ada detail direkam.</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                        Belum ada log aktivitas yang terekam.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($activities->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $activities->links() }}
    </div>
    @endif
</div>
@endsection
