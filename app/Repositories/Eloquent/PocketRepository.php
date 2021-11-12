<?php

namespace App\Repositories\Eloquent;

use App\Models\Pocket;
use App\Repositories\Contracts\PocketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InvalidArgumentException;


class PocketRepository extends BaseRepository implements PocketRepositoryInterface
{
    public function __construct(Pocket $model)
    {
        parent::__construct($model);
    }

    public function detailsPocketById(int $pocketId): ?Collection
    {
        $pockets =  $this->model->findOrFail($pocketId)->with('contents')->get();
        return $pockets;
    }

    /**
     * Paginate the given query.
     *
     * @param  int|null  $perPage
     * @param  array  $columns
     * @param  string  $pageName
     * @param  int|null  $page
     * @return LengthAwarePaginator
     *
     * @throws InvalidArgumentException
     */
    public function getPocketsWithContents($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->model->with('contents')->select($columns)->paginate($perPage);
    }
}
