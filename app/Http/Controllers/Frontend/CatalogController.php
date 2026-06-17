<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Catalog::where('is_active', true);

        // Filter by search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        // Filter by category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Get all active catalogs ordered by publish date (newest first)
        $catalogs = $query->orderBy('publish_date', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->paginate(12)
                          ->withQueryString(); // Keep query params in pagination links
                          
        // Get unique categories for the tabs
        $categories = Catalog::where('is_active', true)
                             ->whereNotNull('category')
                             ->where('category', '!=', '')
                             ->select('category')
                             ->distinct()
                             ->pluck('category');

        return view('frontend.catalogs.index', compact('catalogs', 'categories'));
    }
}
