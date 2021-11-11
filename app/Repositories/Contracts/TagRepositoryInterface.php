<?php

namespace App\Repositories\Contracts;

interface TagRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByContent($contentId);
}
