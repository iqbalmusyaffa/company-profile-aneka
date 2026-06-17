<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Promotion;
use App\Models\Faq;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function gallery()
    {
        $galleries = Gallery::with('media')->latest()->get();
        return view('frontend.pages.gallery', compact('galleries'));
    }

    public function promo()
    {
        $promotions = Promotion::with('media')
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->latest()
            ->get();
            
        return view('frontend.pages.promo', compact('promotions'));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)->get();
        return view('frontend.pages.faq', compact('faqs'));
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function privacy()
    {
        return view('frontend.pages.privacy');
    }
}
