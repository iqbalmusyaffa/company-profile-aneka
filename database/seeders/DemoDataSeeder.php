<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding demo data with images...');

        // 1. Kategori: Semen & Mortar
        $categorySemen = Category::firstOrCreate([
            'name' => 'Semen & Mortar',
            'slug' => Str::slug('Semen & Mortar')
        ]);
        
        $cementImagePath = public_path('images/cement.png');
        if (file_exists($cementImagePath) && $categorySemen->getMedia('categories')->count() == 0) {
            $categorySemen->addMedia($cementImagePath)
                ->preservingOriginal()
                ->toMediaCollection('categories');
        }

        // 2. Kategori: Besi & Baja
        $categoryBesi = Category::firstOrCreate([
            'name' => 'Besi & Baja',
            'slug' => Str::slug('Besi & Baja')
        ]);
        
        $steelImagePath = public_path('images/steel.png');
        if (file_exists($steelImagePath) && $categoryBesi->getMedia('categories')->count() == 0) {
            $categoryBesi->addMedia($steelImagePath)
                ->preservingOriginal()
                ->toMediaCollection('categories');
        }

        // 3. Produk: Semen Gresik
        $productSemen = Product::firstOrCreate(
            ['slug' => Str::slug('Semen Gresik 40kg (PCC)')],
            [
                'category_id' => $categorySemen->id,
                'name' => 'Semen Gresik 40kg (PCC)',
                'sku' => 'SG-PCC-40',
                'description' => '<p>Semen Gresik PCC berkualitas tinggi untuk konstruksi.</p>',
                'price' => 55000,
                'is_featured' => true,
            ]
        );
        
        if (file_exists($cementImagePath) && $productSemen->getMedia('products')->count() == 0) {
            $productSemen->addMedia($cementImagePath)
                ->preservingOriginal()
                ->toMediaCollection('products');
        }

        // 4. Produk: Besi Beton
        $productBesi = Product::firstOrCreate(
            ['slug' => Str::slug('Besi Beton Polos 10mm')],
            [
                'category_id' => $categoryBesi->id,
                'name' => 'Besi Beton Polos 10mm',
                'sku' => 'BB-10-POLOS',
                'description' => '<p>Besi beton polos ukuran 10mm, panjang standar 12m SNI.</p>',
                'price' => 72500,
                'is_featured' => true,
            ]
        );
        
        if (file_exists($steelImagePath) && $productBesi->getMedia('products')->count() == 0) {
            $productBesi->addMedia($steelImagePath)
                ->preservingOriginal()
                ->toMediaCollection('products');
        }

        $this->command->info('Demo data seeded successfully!');
    }
}
