<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apakah melayani pengiriman ke luar kota Banyuwangi?',
                'answer' => 'Saat ini armada kami memprioritaskan pengiriman gratis untuk area Kabupaten Banyuwangi dengan minimal pembelanjaan tertentu. Untuk pengiriman ke luar kota, silakan hubungi tim CS kami terlebih dahulu untuk mengecek ketersediaan rute dan biaya ekspedisi tambahan.',
                'is_active' => true,
            ],
            [
                'question' => 'Berapa minimal belanja untuk mendapatkan Gratis Ongkir?',
                'answer' => 'Gratis ongkir berlaku untuk pembelanjaan minimal Rp 3.000.000 dengan jarak maksimal 15 km dari lokasi Toko Bangunan Aneka Jaya. Untuk jarak yang lebih jauh atau nominal belanja di bawah batas tersebut, akan dikenakan biaya kirim yang sangat terjangkau.',
                'is_active' => true,
            ],
            [
                'question' => 'Apakah bisa retur barang jika ada kelebihan material?',
                'answer' => 'Barang yang sudah dibeli dan dikirim tidak dapat dikembalikan secara sepihak, kecuali terdapat cacat produksi dari pabrik atau tidak sesuai dengan spesifikasi pesanan awal. Khusus untuk material curah (pasir, batu bata, kerikil), kami tidak menerima retur dalam bentuk apa pun.',
                'is_active' => true,
            ],
            [
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Kami melayani pembayaran tunai di toko (Cash), Transfer Bank (BCA, Mandiri, BNI, BRI), dan pembayaran menggunakan QRIS. Pemesanan jarak jauh dapat diselesaikan dengan cara transfer bank terlebih dahulu sebelum barang dikirim.',
                'is_active' => true,
            ],
            [
                'question' => 'Apakah Aneka Jaya melayani pembelian partai besar / grosir untuk proyek?',
                'answer' => 'Tentu saja! Kami sangat menyambut kontraktor dan pemborong. Kami memiliki penawaran harga khusus (grosir) untuk pembelian dalam skala besar atau untuk keperluan proyek konstruksi. Silakan kirimkan Rencana Anggaran Biaya (RAB) Anda kepada tim kami untuk mendapatkan penawaran harga terbaik.',
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama waktu pengiriman barang?',
                'answer' => 'Pesanan yang telah dikonfirmasi pembayarannya sebelum pukul 12.00 siang akan kami upayakan untuk dikirim pada hari yang sama. Pesanan di atas jam tersebut akan dikirim keesokan harinya, bergantung pada jadwal rute armada pengiriman kami.',
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
