<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with(['category', 'brand'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kategori',
            'Merek',
            'Nama Produk',
            'SKU',
            'Harga',
            'Unggulan',
            'Dibuat Pada'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->category ? $product->category->name : '-',
            $product->brand ? $product->brand->name : '-',
            $product->name,
            $product->sku,
            $product->price,
            $product->is_featured ? 'Ya' : 'Tidak',
            $product->created_at ? $product->created_at->format('Y-m-d H:i') : ''
        ];
    }
}
