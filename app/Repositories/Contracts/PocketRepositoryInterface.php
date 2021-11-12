<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InvalidArgumentException;

interface PocketRepositoryInterface extends EloquentRepositoryInterface
{
    public function detailsPocketById(int $pocketId): ?Collection;

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
    public function getPocketsWithContents($perPage = null, $columns = ['*'], $pageName = 'page', $page = null);
}
