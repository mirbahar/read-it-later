<?php

namespace App\Repositories\Eloquent;

use App\Models\Content;
use App\Repositories\Contracts\ContentRepositoryInterface;

class ContentRepository extends BaseRepository implements ContentRepositoryInterface
{
    public function __construct(Content $model)
    {
        parent::__construct($model);
    }
}
