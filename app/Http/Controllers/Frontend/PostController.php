<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Post::with('media', 'category', 'author')->where('status', 'published');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', '%' . $search . '%');
        }

        $posts = $query->latest()->paginate(9);
        $categories = \App\Models\Category::all();

        return view('frontend.blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = \App\Models\Post::with('media', 'category', 'author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedPosts = \App\Models\Post::with('media', 'category')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
            
        $categories = \App\Models\Category::all();

        return view('frontend.blog.show', compact('post', 'relatedPosts', 'categories'));
    }
}
