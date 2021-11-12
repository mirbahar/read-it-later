<?php

namespace App\Repositories\Contracts;

interface ContentRepositoryInterface extends EloquentRepositoryInterface
{
    public function contentDeleteByUrl(string $url);

    public function getAllContentByHashTag(array $hashTag);
}
