<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface PocketServiceInterface
{
    public function getPocketList(Request $request): LengthAwarePaginator;

    public function storePocket(array $data);

    public function detailsPocketById(int $pocketId): ?Collection;

    /**
     * @param int $pocketId
     * @return bool|null
    */
    public function deletePocketById(int $pocketId);
}
