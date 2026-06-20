<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BrandService;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BrandsExport;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function report()
    {
        $brands = Brand::withCount('products')
            ->withSum('products', 'views')
            ->with('topProduct')
            ->orderByDesc('products_count')
            ->paginate(10);
            
        $brands->appends(request()->query());

        $activeCount = Brand::where('is_active', true)->count();
        $inactiveCount = Brand::where('is_active', false)->count();

        return view('admin.brands.report', compact('brands', 'activeCount', 'inactiveCount'));
    }

    public function exportPdf()
    {
        $brands = Brand::withCount('products')->withSum('products', 'views')->get();
        $pdf = Pdf::loadView('admin.brands.report-pdf', compact('brands'))->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Merek_' . date('Ymd_His') . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new BrandsExport, 'Laporan_Merek_' . date('Ymd_His') . '.xlsx');
    }

    public function index()
    {
        $brands = $this->brandService->paginate(5);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['slug'] = \Illuminate\Support\Str::slug($data['name']) . '-' . uniqid();
        $this->brandService->create($data);

        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $brand = $this->brandService->findById($id);
        return view('admin.brands.form', compact('brand'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        $data['is_active'] = $request->has('is_active');
        if($request->name) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']) . '-' . uniqid();
        }
        $this->brandService->update($id, $data);

        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->brandService->delete($id);
        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil dihapus.');
    }
}
