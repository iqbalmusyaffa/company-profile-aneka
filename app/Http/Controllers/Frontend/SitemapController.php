<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\SeoPage;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];
        $now = now()->toAtomString();

        // 1. Halaman Statis Utama
        $urls[] = ['loc' => route('home'), 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '1.0'];
        $urls[] = ['loc' => route('about'), 'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'];
        $urls[] = ['loc' => route('contact.index'), 'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'];
        $urls[] = ['loc' => route('product.index'), 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['loc' => route('blog.index'), 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['loc' => route('gallery'), 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.8'];
        $urls[] = ['loc' => route('promo'), 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.8'];
        $urls[] = ['loc' => route('faq'), 'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.7'];

        // 2. SEO Pages Dinamis (Seperti Terms, Privacy, dsb yang ada di tabel seo_pages)
        $seoPages = SeoPage::all();
        foreach ($seoPages as $page) {
            $urls[] = [
                'loc' => url($page->slug),
                'lastmod' => $page->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ];
        }

        // 3. Produk Aktif
        $products = Product::where('status', 'active')->get();
        foreach ($products as $product) {
            $urls[] = [
                'loc' => route('product.show', $product->slug),
                'lastmod' => $product->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ];
        }

        // 4. Kategori
        $categories = Category::all();
        foreach ($categories as $category) {
            $urls[] = [
                'loc' => route('category.show', $category->slug),
                'lastmod' => $category->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // 5. Merek
        $brands = Brand::all();
        foreach ($brands as $brand) {
            $urls[] = [
                'loc' => route('brand.show', $brand->slug),
                'lastmod' => $brand->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // 6. Artikel Blog
        $posts = Post::where('status', 'published')->get();
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => route('blog.show', $post->slug),
                'lastmod' => $post->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ];
        }

        return response()->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }
}
