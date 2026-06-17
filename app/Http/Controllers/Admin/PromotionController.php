<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PromotionService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    protected $promotionService;

    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        $promotions = $this->promotionService->paginate(5);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except(['image', '_token']);
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        
        $promotion = $this->promotionService->create($data);

        if ($request->hasFile('image')) {
            $promotion->addMedia($request->file('image'))->toMediaCollection('promotions');
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $promotion = $this->promotionService->findById($id);
        return view('admin.promotions.form', compact('promotion'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except(['image', '_token', '_method']);
        
        if ($request->has('title')) {
             $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        $this->promotionService->update($id, $data);
        
        $promotion = $this->promotionService->findById($id);

        if ($request->hasFile('image')) {
            $promotion->clearMediaCollection('promotions');
            $promotion->addMedia($request->file('image'))->toMediaCollection('promotions');
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->promotionService->delete($id);
        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil dihapus.');
    }
}
