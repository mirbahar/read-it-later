<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    public function create(array $attributes): Model;

    public function find(int $id): ?Model;

    public function all(): Collection;

    public function delete(int $id): int;

    public function paginate(Request $request): LengthAwarePaginator;
}
