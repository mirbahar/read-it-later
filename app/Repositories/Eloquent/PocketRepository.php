<?php

namespace App\Repositories\Eloquent;

use App\Models\Pocket;
use App\Repositories\Contracts\PocketRepositoryInterface;

class PocketRepository extends BaseRepository implements PocketRepositoryInterface
{
    public function __construct(Pocket $model)
    {
        parent::__construct($model);
    }
}
