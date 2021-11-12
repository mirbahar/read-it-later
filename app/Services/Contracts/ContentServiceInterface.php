<?php

namespace App\Services\Contracts;

interface ContentServiceInterface
{
    /**
     * @param $data
     */
    public function createContent($data);

    /**
     * @param $url
     */
    public function contentDeleteByUrl($url);

    public function getPocketList($perPage);

    public function getAllContentByHashTag(string $hashTag);
}
