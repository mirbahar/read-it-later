<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PocketRepositoryInterface extends EloquentRepositoryInterface
{
    public function detailsPocketById(int $pocketId): ?Collection;
}
