<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = \App\Models\Product::with('media', 'category')
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = \App\Models\Category::with('media')
            ->product()
            ->get();

        $brands = \App\Models\Brand::with('media')
            ->get();

        $latestPosts = \App\Models\Post::with('media', 'category')
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $promotions = \App\Models\Promotion::with('media')
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->latest()
            ->take(2)
            ->get();

        $testimonials = \App\Models\Testimonial::latest()->take(6)->get();

        $faqs = \App\Models\Faq::where('is_active', true)->take(5)->get();

        $trendingProducts = \App\Models\Product::with('media', 'category')
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();

        return view('frontend.home', compact('featuredProducts', 'categories', 'brands', 'latestPosts', 'promotions', 'testimonials', 'faqs', 'trendingProducts'));
    }
}
