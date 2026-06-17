<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SeoPageService;
use Illuminate\Http\Request;

class SeoPageController extends Controller
{
    protected $seoPageService;

    public function __construct(SeoPageService $seoPageService)
    {
        $this->seoPageService = $seoPageService;
    }

    public function index()
    {
        $seoPages = $this->seoPageService->paginate(5);
        return view('admin.seo-pages.index', compact('seoPages'));
    }

    public function create()
    {
        return view('admin.seo-pages.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|string|unique:seo_pages,url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $this->seoPageService->create($data);

        return redirect()->route('admin.seo-pages.index')->with('success', 'SEO Page berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $seoPage = $this->seoPageService->findById($id);
        return view('admin.seo-pages.form', compact('seoPage'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'url' => 'required|string|unique:seo_pages,url,' . $id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $this->seoPageService->update($id, $data);

        return redirect()->route('admin.seo-pages.index')->with('success', 'SEO Page berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->seoPageService->delete($id);
        return redirect()->route('admin.seo-pages.index')->with('success', 'SEO Page berhasil dihapus.');
    }
}
