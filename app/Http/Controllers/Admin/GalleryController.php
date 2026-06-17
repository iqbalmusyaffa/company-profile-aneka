<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function index()
    {
        $galleries = $this->galleryService->paginate(5);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048'
        ]);

        $data = $request->except(['image', '_token']);
        $gallery = $this->galleryService->create($data);

        if ($request->hasFile('image')) {
            $gallery->addMedia($request->file('image'))->toMediaCollection('galleries');
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $gallery = $this->galleryService->findById($id);
        return view('admin.galleries.form', compact('gallery'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except(['image', '_token', '_method']);
        $this->galleryService->update($id, $data);
        
        $gallery = $this->galleryService->findById($id);

        if ($request->hasFile('image')) {
            $gallery->clearMediaCollection('galleries');
            $gallery->addMedia($request->file('image'))->toMediaCollection('galleries');
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->galleryService->delete($id);
        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
