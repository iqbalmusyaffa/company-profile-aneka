<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\SeoPage;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Promotion;
use App\Models\Catalog;

class DummyAllFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wa = '123456789';

        $this->command->info('Seeding all dummy features for WA ' . $wa . '...');

        // 1. Settings
        $settings = [
            'whatsapp' => $wa,
            'phone' => $wa,
            'company_phone' => $wa,
            'contact_number' => $wa,
        ];
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Brands
        $brand = Brand::firstOrCreate([
            'name' => 'Brand ' . $wa,
            'slug' => Str::slug('Brand ' . $wa)
        ]);

        // 3. Categories
        $category = Category::firstOrCreate([
            'name' => 'Kategori ' . $wa,
            'slug' => Str::slug('Kategori ' . $wa)
        ]);

        // 4. Products
        Product::firstOrCreate(
            ['slug' => Str::slug('Produk WA ' . $wa)],
            [
                'category_id' => $category->id,
                'name' => 'Produk WA ' . $wa,
                'sku' => 'SKU-' . $wa,
                'description' => '<p>Deskripsi produk dummy. Untuk pemesanan hubungi WA: ' . $wa . '</p>',
                'price' => 123456,
                'is_featured' => true,
            ]
        );

        // 5. Posts
        $user = \App\Models\User::first();
        $userId = $user ? $user->id : 1;

        Post::firstOrCreate(
            ['slug' => Str::slug('Artikel WA ' . $wa)],
            [
                'title' => 'Artikel WA ' . $wa,
                'content' => '<p>Konten artikel dummy. Info lebih lanjut hubungi WA ' . $wa . '</p>',
                'user_id' => $userId,
                'category_id' => $category->id,
            ]
        );

        // 6. SeoPages
        SeoPage::firstOrCreate(
            ['url' => '/home'],
            [
                'meta_title' => 'Home - WA ' . $wa,
                'meta_description' => 'Hubungi kami di WA ' . $wa,
                'open_graph_data' => json_encode(['title' => 'Home - WA ' . $wa]),
            ]
        );

        // 7. Galleries
        Gallery::firstOrCreate([
            'title' => 'Galeri WA ' . $wa,
        ]);

        // 8. Testimonials
        Testimonial::firstOrCreate([
            'customer_name' => 'Pelanggan ' . $wa,
            'rating' => 5,
            'comment' => 'Pelayanan sangat bagus, saya dihubungi langsung via WA ' . $wa,
        ]);

        // 9. Faqs
        Faq::firstOrCreate([
            'question' => 'Berapa nomor WA Customer Service?',
            'answer' => 'Anda bisa menghubungi kami di nomor WA: ' . $wa,
        ]);

        // 10. Promotions
        Promotion::firstOrCreate([
            'slug' => Str::slug('Promo Spesial WA ' . $wa),
        ], [
            'title' => 'Promo Spesial WA ' . $wa,
            'description' => 'Dapatkan diskon khusus dengan menghubungi WA ' . $wa,
        ]);

        // 11. Catalogs
        Catalog::firstOrCreate([
            'title' => 'Katalog WA ' . $wa,
        ], [
            'publish_date' => now(),
            'category' => 'Dummy Category WA ' . $wa,
        ]);

        $this->command->info('Dummy features seeded successfully!');
    }
}
