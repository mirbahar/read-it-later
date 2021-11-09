<?php

namespace App\Repositories\Eloquent;

use App\Models\Pocket;
use App\Repositories\Contracts\PocketRepositoryInterface;
use Illuminate\Support\Collection;

class PocketRepository extends BaseRepository implements PocketRepositoryInterface
{

    /**
     * PocketRepository constructor.
     *
     * @param Pocket $model
     */
    public function __construct(Pocket $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
