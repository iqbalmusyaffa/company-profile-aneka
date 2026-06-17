@extends('layouts.app')

@section('title', 'Kebijakan Privasi - Toko Bangunan Aneka Jaya')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-10 border-b border-gray-100">
                <h1 class="text-3xl font-extrabold text-primary-950 tracking-tight">Kebijakan Privasi</h1>
                <p class="text-gray-500 mt-2">Terakhir diperbarui: {{ date('d F Y') }}</p>
            </div>
            
            <div class="px-8 py-8 prose prose-primary max-w-none text-gray-600">
                <h2>1. Perlindungan Data Anda</h2>
                <p>Toko Bangunan Aneka Jaya sangat menghargai privasi dan keamanan data pribadi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi yang Anda berikan saat menggunakan layanan kami.</p>

                <h2>2. Informasi yang Kami Kumpulkan</h2>
                <p>Kami mungkin mengumpulkan beberapa informasi pribadi Anda, termasuk namun tidak terbatas pada:</p>
                <ul>
                    <li>Nama lengkap.</li>
                    <li>Informasi kontak (Nomor Telepon, Nomor WhatsApp, dan Email).</li>
                    <li>Alamat pengiriman proyek/rumah Anda.</li>
                    <li>Data riwayat transaksi dan preferensi belanja material Anda.</li>
                </ul>

                <h2>3. Bagaimana Kami Menggunakan Informasi Anda</h2>
                <p>Informasi yang kami kumpulkan digunakan untuk tujuan berikut:</p>
                <ul>
                    <li>Memproses pesanan dan memastikan pengiriman material bangunan Anda tepat sasaran.</li>
                    <li>Menghubungi Anda terkait pembaruan status pesanan, faktur, atau ketersediaan stok barang.</li>
                    <li>Mengirimkan penawaran promosi atau informasi produk terbaru (jika Anda berlangganan).</li>
                    <li>Meningkatkan kualitas layanan dan antarmuka website kami.</li>
                </ul>

                <h2>4. Keamanan Informasi</h2>
                <p>Kami berkomitmen untuk memastikan bahwa informasi Anda aman. Untuk mencegah akses tidak sah atau penyalahgunaan data, kami menerapkan prosedur fisik, elektronik, dan manajerial yang sesuai untuk melindungi dan mengamankan informasi yang kami kumpulkan secara online.</p>

                <h2>5. Berbagi Data dengan Pihak Ketiga</h2>
                <p>Kami tidak akan menjual, mendistribusikan, atau menyewakan informasi pribadi Anda kepada pihak ketiga kecuali kami memiliki izin dari Anda atau diwajibkan oleh hukum untuk melakukannya.</p>

                <h2>6. Tautan ke Website Lain</h2>
                <p>Website kami mungkin berisi tautan ke situs web lain yang menarik (seperti halaman brand mitra kami). Namun, setelah Anda menggunakan tautan ini untuk meninggalkan situs kami, Anda harus perhatikan bahwa kami tidak memiliki kendali atas situs web lain tersebut. Oleh karena itu, kami tidak dapat bertanggung jawab atas perlindungan dan privasi informasi apa pun yang Anda berikan saat mengunjungi situs tersebut.</p>

                <h2>7. Pertanyaan Mengenai Privasi</h2>
                <p>Jika Anda meyakini bahwa ada informasi terkait Anda yang kami simpan tidak benar atau tidak lengkap, atau jika Anda ingin menghapus data Anda dari sistem kami, silakan hubungi kami secepatnya melalui informasi kontak yang tersedia di website kami.</p>
            </div>
        </div>
    </div>
</div>
@endsection
