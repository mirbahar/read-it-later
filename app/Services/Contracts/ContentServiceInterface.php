<?php

namespace App\Services\Contracts;

interface ContentServiceInterface
{
    /**
     * @param $data
     */
    public function createContent($data);

    public function contentDeleteByUrl(string $url): int;

    public function getPocketList($perPage);

    public function getAllContentByHashTag(string $hashTag);
}
