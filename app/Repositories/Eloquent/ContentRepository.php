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

    public function contentDeleteByUrl(string $url)
    {
        $deletedRows = $this->model->where('url', $url)->with('tags')->delete();

        return $deletedRows;
    }

    public function getAllContentByHashTag(array $hashTag)
    {
        $contents = $this->model
            ->join('tags', 'contents.id', '=', 'tags.content_id')
            ->whereIn('tags.name', $hashTag)->get();

        return $contents;
    }
}
