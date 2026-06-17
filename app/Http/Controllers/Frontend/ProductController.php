<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Product::with('media', 'category', 'brand');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $products = $query->latest()->paginate(12);
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();
        
        return view('frontend.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = \App\Models\Product::with('media', 'category', 'brand')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = \App\Models\Product::with('media')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }

    public function category($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        
        $products = \App\Models\Product::with('media', 'category', 'brand')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12);
            
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();

        return view('frontend.products.index', compact('products', 'categories', 'category', 'brands'));
    }

    public function brand($slug)
    {
        $brand = \App\Models\Brand::where('slug', $slug)->firstOrFail();
        
        $products = \App\Models\Product::with('media', 'category', 'brand')
            ->where('brand_id', $brand->id)
            ->latest()
            ->paginate(12);
            
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();

        return view('frontend.products.index', compact('products', 'categories', 'brand', 'brands'));
    }
}
