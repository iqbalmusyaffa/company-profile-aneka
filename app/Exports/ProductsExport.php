<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Collection;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kategori',
            'Merek',
            'Nama Produk',
            'SKU',
            'Stok',
            'Harga Asli',
            'Harga Jual',
            'Jumlah Dilihat',
            'Status',
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
            $product->stock,
            $product->original_price,
            $product->price,
            $product->views ?? 0,
            $product->is_active ? 'Aktif' : 'Draft',
            $product->is_featured ? 'Ya' : 'Tidak',
            $product->created_at ? $product->created_at->format('Y-m-d H:i') : ''
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $totalProducts = $this->products->count();
                $totalViews = $this->products->sum('views');
                $avgPrice = $totalProducts > 0 ? $this->products->avg('price') : 0;
                $lowStock = $this->products->where('stock', '<', 10)->count();
                $assetValue = $this->products->sum(function($product) {
                    return $product->price * $product->stock;
                });
                
                $topProducts = $this->products->sortByDesc('views')->take(3);
                $topNames = $topProducts->pluck('name')->implode(', ');

                $lastRow = $totalProducts + 1; 
                
                $sheet = $event->sheet->getDelegate();
                
                $sheet->setCellValue('A' . ($lastRow + 2), 'ANALISA DATA PRODUK');
                $sheet->getStyle('A' . ($lastRow + 2))->getFont()->setBold(true);

                $sheet->setCellValue('A' . ($lastRow + 3), 'Total Keseluruhan Produk:');
                $sheet->setCellValue('B' . ($lastRow + 3), $totalProducts);

                $sheet->setCellValue('A' . ($lastRow + 4), 'Total Produk Dilihat:');
                $sheet->setCellValue('B' . ($lastRow + 4), $totalViews);

                $sheet->setCellValue('A' . ($lastRow + 5), 'Rata-rata Harga Produk:');
                $sheet->setCellValue('B' . ($lastRow + 5), 'Rp ' . number_format($avgPrice, 0, ',', '.'));

                $sheet->setCellValue('A' . ($lastRow + 6), 'Produk Stok Menipis (< 10):');
                $sheet->setCellValue('B' . ($lastRow + 6), $lowStock . ' Produk');

                $sheet->setCellValue('A' . ($lastRow + 7), 'Top 3 Produk Populer:');
                $sheet->setCellValue('B' . ($lastRow + 7), $topNames ?: '-');

                $sheet->setCellValue('A' . ($lastRow + 8), 'Perkiraan Nilai Inventaris:');
                $sheet->setCellValue('B' . ($lastRow + 8), 'Rp ' . number_format($assetValue, 0, ',', '.'));
                
                foreach (range('A', 'L') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
