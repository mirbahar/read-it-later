<?php

namespace App\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

interface ContentServiceInterface
{

    public function createContent(array $data): JsonResource;

    public function contentDeleteByUrl(string $url): int;

    public function getContentList(Request $request): LengthAwarePaginator;

    public function getAllContentByHashTag(string $hashTag): ?Collection;
}
