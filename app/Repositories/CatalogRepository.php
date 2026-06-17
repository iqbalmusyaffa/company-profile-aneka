<?php

namespace App\Repositories;

use App\Models\Catalog;
use App\Repositories\Contracts\CatalogRepositoryInterface;

class CatalogRepository extends BaseRepository implements CatalogRepositoryInterface
{
    public function __construct(Catalog $model)
    {
        parent::__construct($model);
    }
}
