<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface PocketServiceInterface
{
    public function getPocketList(Request $request): LengthAwarePaginator;

    public function storePocket(array $data);
}
