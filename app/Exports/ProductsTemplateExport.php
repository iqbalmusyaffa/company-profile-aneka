<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            // Sample row
            ['1', '1', 'Besi Beton 10mm SNI', 'besi-beton-10mm-sni', 'BST-10', 'Besi beton kualitas standar SNI.', '65000', '1', '0']
        ];
    }

    public function headings(): array
    {
        return [
            'category_id',
            'brand_id',
            'name',
            'slug',
            'sku',
            'description',
            'price',
            'is_active',
            'is_featured'
        ];
    }
}
