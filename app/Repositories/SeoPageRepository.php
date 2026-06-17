<?php

namespace App\Repositories;

use App\Models\SeoPage;
use App\Repositories\Contracts\SeoPageRepositoryInterface;

class SeoPageRepository extends BaseRepository implements SeoPageRepositoryInterface
{
    public function __construct(SeoPage $model)
    {
        parent::__construct($model);
    }
}
