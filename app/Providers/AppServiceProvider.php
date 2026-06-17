<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Contracts\CategoryRepositoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Repositories\Contracts\BrandRepositoryInterface::class, \App\Repositories\BrandRepository::class);
        $this->app->bind(\App\Repositories\Contracts\ProductRepositoryInterface::class, \App\Repositories\ProductRepository::class);
        $this->app->bind(\App\Repositories\Contracts\PostRepositoryInterface::class, \App\Repositories\PostRepository::class);
        $this->app->bind(\App\Repositories\Contracts\SeoPageRepositoryInterface::class, \App\Repositories\SeoPageRepository::class);
        $this->app->bind(\App\Repositories\Contracts\GalleryRepositoryInterface::class, \App\Repositories\GalleryRepository::class);
        $this->app->bind(\App\Repositories\Contracts\TestimonialRepositoryInterface::class, \App\Repositories\TestimonialRepository::class);
        $this->app->bind(\App\Repositories\Contracts\FaqRepositoryInterface::class, \App\Repositories\FaqRepository::class);
        $this->app->bind(\App\Repositories\Contracts\PromotionRepositoryInterface::class, \App\Repositories\PromotionRepository::class);
        $this->app->bind(\App\Repositories\Contracts\SettingRepositoryInterface::class, \App\Repositories\SettingRepository::class);
        $this->app->bind(\App\Repositories\Contracts\CatalogRepositoryInterface::class, \App\Repositories\CatalogRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            // Only query if the settings table exists to prevent errors during initial migration
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
                $view->with('settings', $settings);
            } else {
                $view->with('settings', []);
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                $navCategories = \App\Models\Category::all();
                $view->with('navCategories', $navCategories);
            } else {
                $view->with('navCategories', collect());
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('catalogs')) {
                $activeCatalog = \App\Models\Catalog::where('is_active', true)->latest('publish_date')->first();
                $view->with('activeCatalog', $activeCatalog);
            } else {
                $view->with('activeCatalog', null);
            }
        });
    }
}
