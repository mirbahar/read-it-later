<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface PocketRepositoryInterface extends EloquentRepositoryInterface
{
    public function detailsPocketById(int $pocketId): ?Collection;

    public function getPocketsWithContents(Request $request): LengthAwarePaginator;
}
