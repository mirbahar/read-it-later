<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ContentRepositoryInterface extends EloquentRepositoryInterface
{
    public function contentDeleteByUrl(string $url): int;
    /**
     * @param array $hashTag
     * @return Collection | null
     */
    public function getAllContentByHashTag(array $hashTag);
}
