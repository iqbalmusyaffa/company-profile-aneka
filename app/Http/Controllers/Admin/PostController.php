<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;
    protected $categoryService;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $posts = \App\Models\Post::with(['category', 'author'])->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.posts.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'boolean',
            'image' => 'nullable|image|max:5120'
        ]);

        $data = $request->except(['image', '_token']);
        $data['status'] = $request->has('is_published') ? 'published' : 'draft';
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        $data['author_id'] = Auth::id(); // Assign current logged in user as author

        $post = $this->postService->create($data);

        if ($request->hasFile('image')) {
            $post->addMedia($request->file('image'))->toMediaCollection('posts');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit(string $id)
    {
        $post = $this->postService->findById($id);
        $categories = $this->categoryService->getAll();
        return view('admin.posts.form', compact('post', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'boolean',
            'image' => 'nullable|image|max:5120'
        ]);

        $data = $request->except(['image', '_token', '_method']);
        $data['status'] = $request->has('is_published') ? 'published' : 'draft';
        if($request->title) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        $this->postService->update($id, $data);
        $post = $this->postService->findById($id);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMedia($request->file('image'))->toMediaCollection('posts');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->postService->delete($id);
        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
