<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ContentRepositoryInterface extends EloquentRepositoryInterface
{
    public function contentDeleteByUrl(string $url): int;

    public function getAllContentByHashTag(array $hashTag): ?Collection;
}
