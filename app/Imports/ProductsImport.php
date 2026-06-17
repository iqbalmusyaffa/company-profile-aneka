<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['name']) || empty($row['price'])) {
            return null;
        }

        return new Product([
            'category_id' => $row['category_id'] ?? null,
            'brand_id'    => $row['brand_id'] ?? null,
            'name'        => $row['name'],
            'slug'        => empty($row['slug']) ? Str::slug($row['name']) : $row['slug'],
            'sku'         => $row['sku'] ?? null,
            'description' => $row['description'] ?? null,
            'price'       => $row['price'],
            'is_active'   => isset($row['is_active']) ? $row['is_active'] : 1,
            'is_featured' => isset($row['is_featured']) ? $row['is_featured'] : 0,
        ]);
    }
}
