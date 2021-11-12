<?php

namespace App\Repositories\Contracts;

interface ContentRepositoryInterface extends EloquentRepositoryInterface
{
    public function contentDeleteByUrl(string $url): int;

    public function getAllContentByHashTag(array $hashTag);
}
