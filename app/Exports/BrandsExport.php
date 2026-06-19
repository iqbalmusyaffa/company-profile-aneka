<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BrandsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Brand::withCount('products')
            ->withSum('products', 'views')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Merek',
            'Status',
            'Total Produk',
            'Total Kunjungan',
            'Tanggal Dibuat',
        ];
    }

    public function map($brand): array
    {
        return [
            $brand->id,
            $brand->name,
            $brand->is_active ? 'Aktif' : 'Nonaktif',
            $brand->products_count ?? 0,
            $brand->products_sum_views ?? 0,
            $brand->created_at ? $brand->created_at->format('d-m-Y H:i') : '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4F46E5']]],
        ];
    }
}
