<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\Contracts\PromotionRepositoryInterface;

class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    public function __construct(Promotion $model)
    {
        parent::__construct($model);
    }
}
