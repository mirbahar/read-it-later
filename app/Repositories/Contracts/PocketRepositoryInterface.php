<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PocketRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;
}
