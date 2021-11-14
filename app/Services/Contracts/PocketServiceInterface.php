<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface PocketServiceInterface
{
    public function getPocketsWithContentList(Request $perPage): LengthAwarePaginator;

    public function storePocket(array $data);

    public function detailsPocketById(int $pocketId): ?Collection;

    public function deletePocketById(int $pocketId): int;
}
