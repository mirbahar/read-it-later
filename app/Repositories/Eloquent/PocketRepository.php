<?php

namespace App\Repositories\Eloquent;

use App\Models\Pocket;
use App\Repositories\Contracts\PocketRepositoryInterface;
use Illuminate\Support\Collection;


class PocketRepository extends BaseRepository implements PocketRepositoryInterface
{
    public function __construct(Pocket $model)
    {
        parent::__construct($model);
    }

    public function detailsPocketById(int $pocketId): ?Collection
    {
        return $this->model->where('id', $pocketId)->with('contents')->get();
    }
}
