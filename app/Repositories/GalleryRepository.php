<?php

namespace App\Repositories;

use App\Models\Gallery;
use App\Repositories\Contracts\GalleryRepositoryInterface;

class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
{
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }
}
