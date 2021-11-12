<?php

namespace App\Services;

use App\Http\Resources\ContentResource;
use App\Repositories\Contracts\ContentRepositoryInterface;
use App\Services\Contracts\ContentServiceInterface;

class ContentService implements ContentServiceInterface
{
    /**
     * @var ContentRepositoryInterface
     */
    private $contentRepository;

    /**
     * Create a new service instance.
     *
     * @param ContentRepositoryInterface $contentRepository
     * @return void
     */
    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createContent($data)
    {
        $content = $this->contentRepository->create($data);
        return new ContentResource($content);
    }
    /**
     * @param $url
     * @return mixed
     */
    public function contentDeleteByUrl($url)
    {
        $content = $this->contentRepository->contentDeleteByUrl($url);
        return new ContentResource($content);
    }

    public function getPocketList($perPage)
    {
        $contents = $this->contentRepository->paginate($perPage);
        return $contents;
    }

    public function getAllContentByHashTag(string $hashTag)
    {
        $hash = explode(',',$hashTag);

        if(!is_array($hash)) {

            return response()->json('use valid hashtag or key words');
        }

        $contents = $this->contentRepository->getAllContentByHashTag($hash);

        return $contents;
    }
}
