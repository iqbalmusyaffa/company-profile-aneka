<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SitemapController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SeoPageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\Admin\AnalyticsController;

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/produk', [FrontendProductController::class, 'index'])->name('product.index');
Route::get('/produk/{slug}', [FrontendProductController::class, 'show'])->name('product.show');
Route::get('/kategori/{slug}', [FrontendProductController::class, 'category'])->name('category.show');
Route::get('/merek/{slug}', [FrontendProductController::class, 'brand'])->name('brand.show');

Route::get('/blog', [FrontendPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [FrontendPostController::class, 'show'])->name('blog.show');

Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/promo', [PageController::class, 'promo'])->name('promo');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Catalogs Download
Route::get('/download', [CatalogController::class, 'index'])->name('catalogs.download');

Route::get('/syarat-ketentuan', [PageController::class, 'terms'])->name('terms');
Route::get('/kebijakan-privasi', [PageController::class, 'privacy'])->name('privacy');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'send'])->name('contact.send');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    Route::resource('categories', CategoryController::class);
    
    Route::get('brands/export-pdf', [BrandController::class, 'exportPdf'])->name('brands.export.pdf');
    Route::get('brands/export-excel', [BrandController::class, 'exportExcel'])->name('brands.export.excel');
    Route::get('brands/report', [BrandController::class, 'report'])->name('brands.report');
    Route::resource('brands', BrandController::class);

    // Reports
    Route::get('products/report', [ProductController::class, 'report'])->name('products.report');
    Route::get('products/export-pdf', [ProductController::class, 'exportPdf'])->name('products.export.pdf');
    Route::get('products/export-excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');

    // Products Resource
    Route::delete('products/{product}/media/{media}', [ProductController::class, 'deleteImage'])->name('products.media.destroy');
    Route::post('products/import', [ProductController::class, 'importExcel'])->name('products.import');
    Route::get('products/download-template', [ProductController::class, 'downloadTemplate'])->name('products.download-template');
    Route::resource('products', ProductController::class);

    // Backups
    Route::get('backups', [BackupController::class, 'index'])->name('backups.index');
    Route::post('backups', [BackupController::class, 'store'])->name('backups.store');
    Route::get('backups/{file}/download', [BackupController::class, 'download'])->name('backups.download');
    Route::delete('backups/{file}', [BackupController::class, 'destroy'])->name('backups.destroy');
    Route::resource('posts', PostController::class);
    Route::resource('seo-pages', SeoPageController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('faqs', AdminFaqController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('catalogs', AdminCatalogController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Theme/Color Examples (Reference Only)
    Route::get('/theme-examples', function () {
        return view('admin.theme.examples');
    })->name('theme.examples');

    // Activity Logs
    Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Admin Users
    Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class)->except(['show']);



    // Visitors Route
    Route::get('/visitors', [\App\Http\Controllers\Admin\VisitorController::class, 'index'])->name('visitors.index');
    Route::get('/visitors/export/pdf', [\App\Http\Controllers\Admin\VisitorController::class, 'exportPdf'])->name('visitors.export.pdf');
    Route::get('/visitors/export/excel', [\App\Http\Controllers\Admin\VisitorController::class, 'exportExcel'])->name('visitors.export.excel');
    Route::post('/visitors/block-ip', [\App\Http\Controllers\Admin\VisitorController::class, 'blockIp'])->name('visitors.block');
    Route::delete('/visitors/unblock-ip/{ip}', [\App\Http\Controllers\Admin\VisitorController::class, 'unblockIp'])->name('visitors.unblock');
});

// User Profile Routes (Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
