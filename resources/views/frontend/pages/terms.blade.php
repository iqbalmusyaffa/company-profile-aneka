@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - Toko Bangunan Aneka Jaya')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-10 border-b border-gray-100">
                <h1 class="text-3xl font-extrabold text-primary-950 tracking-tight">Syarat & Ketentuan Layanan</h1>
                <p class="text-gray-500 mt-2">Terakhir diperbarui: {{ date('d F Y') }}</p>
            </div>
            
            <div class="px-8 py-8 prose prose-primary max-w-none text-gray-600">
                <h2>1. Pendahuluan</h2>
                <p>Selamat datang di Toko Bangunan Aneka Jaya. Dengan mengakses dan menggunakan layanan kami, baik melalui website ini maupun secara langsung di toko fisik, Anda dianggap telah membaca, memahami, dan menyetujui seluruh Syarat dan Ketentuan yang berlaku.</p>

                <h2>2. Pemesanan dan Pembayaran</h2>
                <ul>
                    <li>Harga yang tertera pada website dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya. Harga yang mengikat adalah harga pada saat Anda melakukan konfirmasi pembayaran.</li>
                    <li>Pembayaran dapat dilakukan melalui metode transfer bank ke rekening resmi Toko Bangunan Aneka Jaya, pembayaran digital (QRIS), atau pembayaran langsung di toko (Cash).</li>
                    <li>Pesanan yang belum dibayar dalam waktu 1x24 jam akan otomatis dibatalkan oleh sistem.</li>
                </ul>

                <h2>3. Kebijakan Pengiriman Barang</h2>
                <ul>
                    <li>Pengiriman barang material besar (seperti pasir, bata, semen dalam jumlah besar) menggunakan armada toko kami.</li>
                    <li>Terdapat syarat minimal belanja untuk mendapatkan layanan gratis ongkos kirim pada area tertentu di wilayah Banyuwangi.</li>
                    <li>Beban biaya bongkar muat di lokasi tujuan (jika membutuhkan tenaga tambahan) menjadi tanggung jawab pembeli, kecuali ada kesepakatan sebelumnya.</li>
                </ul>

                <h2>4. Kebijakan Retur dan Pengembalian</h2>
                <p>Kami memastikan semua barang yang dikirim dalam kondisi baik. Jika terdapat kerusakan, cacat, atau ketidaksesuaian pesanan, harap mengikuti langkah berikut:</p>
                <ul>
                    <li>Laporan keluhan harus disampaikan maksimal 1x24 jam setelah barang diterima, disertai bukti foto atau video yang jelas.</li>
                    <li>Barang yang akan diretur (dikembalikan) harus dalam kondisi utuh seperti semula dan belum digunakan. Khusus untuk material curah (seperti pasir) tidak dapat dikembalikan.</li>
                    <li>Keputusan terkait pergantian barang atau pengembalian dana sepenuhnya adalah hak Toko Bangunan Aneka Jaya setelah melakukan evaluasi.</li>
                </ul>

                <h2>5. Perubahan Syarat dan Ketentuan</h2>
                <p>Kami berhak untuk mengubah, memodifikasi, menambah, atau menghapus bagian mana pun dari Syarat dan Ketentuan ini kapan saja tanpa pemberitahuan sebelumnya. Anda disarankan untuk memeriksa halaman ini secara berkala untuk mengetahui perubahan apa pun.</p>

                <h2>6. Hubungi Kami</h2>
                <p>Jika Anda memiliki pertanyaan mengenai Syarat dan Ketentuan ini, jangan ragu untuk menghubungi tim layanan pelanggan kami melalui WhatsApp atau email resmi yang tertera di halaman kontak.</p>
            </div>
        </div>
    </div>
</div>
@endsection
