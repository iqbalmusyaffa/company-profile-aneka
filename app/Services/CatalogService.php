<?php

namespace App\Services;

use App\Repositories\Contracts\CatalogRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CatalogService
{
    protected $catalogRepository;

    public function __construct(CatalogRepositoryInterface $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    public function getAllPaginated($perPage = 10)
    {
        return $this->catalogRepository->paginate($perPage);
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $catalog = $this->catalogRepository->create($data);

            if (isset($data['pdf_file'])) {
                $catalog->addMedia($data['pdf_file'])
                       ->toMediaCollection('catalogs');
            }

            DB::commit();
            return $catalog;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating catalog: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $catalog = $this->catalogRepository->update($id, $data);

            if (isset($data['pdf_file'])) {
                $catalog->clearMediaCollection('catalogs');
                $catalog->addMedia($data['pdf_file'])
                       ->toMediaCollection('catalogs');
            }

            DB::commit();
            return $catalog;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating catalog: ' . $e->getMessage());
            throw $e;
        }
    }

    public function delete($id)
    {
        return $this->catalogRepository->delete($id);
    }

    public function getActiveCatalog()
    {
        // Get the latest active catalog based on publish_date or created_at
        return \App\Models\Catalog::where('is_active', true)
                                  ->orderBy('publish_date', 'desc')
                                  ->orderBy('created_at', 'desc')
                                  ->first();
    }
}
