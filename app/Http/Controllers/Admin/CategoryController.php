<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $query = \App\Models\Category::query();
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        $categories = $query->latest()->paginate(5)->appends($request->query());
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        // Checkbox HTML sends nothing if unchecked, so we check if it exists
        $data['is_active'] = $request->has('is_active');
        $data['slug'] = \Illuminate\Support\Str::slug($data['name']) . '-' . uniqid();
        
        $category = $this->categoryService->create($data);

        if ($request->hasFile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('categories');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $category = $this->categoryService->findById($id);
        return view('admin.categories.form', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');
        if(isset($data['name'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']) . '-' . uniqid();
        }
        
        $this->categoryService->update($id, $data);
        
        $category = $this->categoryService->findById($id);

        if ($request->hasFile('image')) {
            $category->clearMediaCollection('categories');
            $category->addMedia($request->file('image'))->toMediaCollection('categories');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
