<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }

    public function index()
    {
        $catalogs = $this->catalogService->getAllPaginated(10);
        return view('admin.catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        return view('admin.catalogs.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'is_active' => 'boolean',
            'pdf_file' => 'required|file|mimes:pdf|max:10240', // 10MB Max
        ]);

        $data = $request->except(['_token', 'pdf_file']);
        $data['is_active'] = $request->has('is_active');
        $data['pdf_file'] = $request->file('pdf_file');

        $this->catalogService->create($data);

        return redirect()->route('admin.catalogs.index')->with('success', 'Katalog berhasil ditambahkan');
    }

    public function edit($id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('admin.catalogs.form', compact('catalog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'is_active' => 'boolean',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = $request->except(['_token', '_method', 'pdf_file']);
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file');
        }

        $this->catalogService->update($id, $data);

        return redirect()->route('admin.catalogs.index')->with('success', 'Katalog berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->catalogService->delete($id);
        return redirect()->route('admin.catalogs.index')->with('success', 'Katalog berhasil dihapus');
    }
}
