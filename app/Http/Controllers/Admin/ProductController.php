<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $brandService;

    public function __construct(ProductService $productService, CategoryService $categoryService, BrandService $brandService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
    }

    public function index()
    {
        $products = \App\Models\Product::with(['category', 'brand'])->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::product()->get();
        $brands = $this->brandService->getAll();
        return view('admin.products.form', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'nullable|image|max:5120',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'nullable|url'
        ]);

        $data = $request->except(['images', 'image_urls', '_token']);
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');
        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        $data['image_urls'] = $this->parseImageUrls($request->input('image_urls', []));

        $product = $this->productService->create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('products');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $product = $this->productService->findById($id);
        $categories = \App\Models\Category::product()->get();
        $brands = $this->brandService->getAll();
        return view('admin.products.form', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $id,
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'nullable|image|max:5120',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'nullable|url'
        ]);

        $data = $request->except(['images', 'image_urls', '_token', '_method']);
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');
        if($request->name) {
             $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        }
        $data['image_urls'] = $this->parseImageUrls($request->input('image_urls', []));

        $this->productService->update($id, $data);
        $product = $this->productService->findById($id);

        if ($request->hasFile('images')) {
            // Note: Tidak menghapus media lama, cukup tambahkan yang baru
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('products');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->productService->delete($id);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function report(Request $request)
    {
        $query = \App\Models\Product::with(['category', 'brand']);
        
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_active', false);
            }
        }

        $allProducts = $query->get();
        $products = (clone $query)->paginate(10, ['*'], 'page')->appends($request->query());
        $topProducts = (clone $query)->orderByDesc('views')->paginate(5, ['*'], 'top_page')->appends($request->query());
        $categories = \App\Models\Category::product()->get();
        
        $assetValue = $allProducts->sum(function($product) {
            return $product->price * $product->stock;
        });

        // Data for Chart (Products by Category)
        $chartData = $allProducts->groupBy(function($item) {
            return $item->category ? $item->category->name : 'Tanpa Kategori';
        })->map->count();

        $analysis = [
            'total_products' => $allProducts->count(),
            'total_active' => $allProducts->where('is_active', true)->count(),
            'total_views' => $allProducts->sum('views'),
            'avg_price' => $allProducts->count() > 0 ? $allProducts->avg('price') : 0,
            'low_stock' => $allProducts->where('stock', '<', 10)->count(),
            'total_asset_value' => $assetValue
        ];

        return view('admin.products.report', compact('products', 'categories', 'analysis', 'chartData', 'topProducts'));
    }

    public function exportPdf(Request $request)
    {
        $query = \App\Models\Product::with(['category', 'brand']);
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_active', false);
            }
        }
        $products = $query->get();
        
        $assetValue = $products->sum(function($product) {
            return $product->price * $product->stock;
        });

        $chartData = $products->groupBy(function($item) {
            return $item->category ? $item->category->name : 'Tanpa Kategori';
        })->map->count();

        $base64Chart = null;
        if ($chartData->count() > 0) {
            $labels = $chartData->keys()->toJson();
            $values = $chartData->values()->toJson();
            $chartConfig = "{type:'doughnut',data:{labels:$labels,datasets:[{data:$values,backgroundColor:['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6','#ec4899','#0ea5e9']}]},options:{plugins:{legend:{position:'right',labels:{fontSize:10}}}}}";
            $chartUrl = 'https://quickchart.io/chart?c=' . urlencode($chartConfig) . '&w=350&h=180';
            
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(10)->withoutVerifying()->get($chartUrl);
                if ($response->successful()) {
                    $base64Chart = 'data:image/png;base64,' . base64_encode($response->body());
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('QuickChart Error: ' . $e->getMessage());
            }
        }

        $analysis = [
            'total_products' => $products->count(),
            'total_views' => $products->sum('views'),
            'avg_price' => $products->count() > 0 ? $products->avg('price') : 0,
            'low_stock' => $products->where('stock', '<', 10)->count(),
            'top_products' => $products->sortByDesc('views')->take(3),
            'total_asset_value' => $assetValue
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.products.export-pdf', compact('products', 'analysis', 'base64Chart'));
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('laporan_produk_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $query = \App\Models\Product::with(['category', 'brand']);
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_active', false);
            }
        }
        $products = $query->get();

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductsExport($products), 'data_produk_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function downloadTemplate()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductsTemplateExport, 'template_import_produk.xlsx');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\ProductsImport, $request->file('file'));
            return redirect()->route('admin.products.index')->with('success', 'Data produk berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    public function deleteImage(string $productId, string $mediaId)
    {
        $product = $this->productService->findById($productId);
        $media = $product->media()->where('id', $mediaId)->first();
        if ($media) {
            $media->delete();
        }
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }

    private function parseImageUrls(array $urls): array
    {
        $parsed = [];
        foreach ($urls as $url) {
            if (empty($url)) continue;
            
            // Konversi berbagai jenis link Google Drive ke direct thumbnail link
            $fileId = null;
            if (preg_match('/drive\.google\.com\/.*\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                $fileId = $matches[1];
            } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $url, $matches) && strpos($url, 'google.com') !== false) {
                $fileId = $matches[1];
            }

            if ($fileId) {
                $parsed[] = "https://drive.google.com/thumbnail?id={$fileId}&sz=w1000";
            } else {
                $parsed[] = $url;
            }
        }
        return array_values(array_unique($parsed));
    }
}
