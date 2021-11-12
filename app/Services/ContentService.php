<?php

namespace App\Services;

use App\Http\Resources\ContentResource;
use App\Repositories\Contracts\ContentRepositoryInterface;
use App\Services\Contracts\ContentServiceInterface;
use Exception;

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

    public function contentDeleteByUrl(string $url): int
    {
        $deletedContent = $this->contentRepository->contentDeleteByUrl($url);

        return $deletedContent;
    }

    public function getPocketList($perPage)
    {
        $contents = $this->contentRepository->paginate($perPage);

        return $contents;
    }

    public function getAllContentByHashTag(string $hashTag)
    {
        try {

            $hash = explode(',',trim($hashTag));

            $hash = array_map(function($item){

                return trim($item);
            }, $hash);

            if(!is_array($hash)) {

                return response()->json('use valid hashTag or key words');
            }

            $contents = $this->contentRepository->getAllContentByHashTag($hash);

            return $contents;

        } catch (Exception $e) {

            throw new Exception('Invalid Hash Tag... Enter Valid HashTag');
        }

    }
}
