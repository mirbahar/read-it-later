<?php

namespace App\Services\Contracts;

interface TagServiceInterface
{
    /**
     * @param $data
     */
    public function createTags($data);

    public function findByContent($contentId);
}
