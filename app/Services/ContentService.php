<?php

namespace App\Services;

use App\Http\Resources\ContentResource;
use App\Repositories\Contracts\ContentRepositoryInterface;
use App\Services\Contracts\ContentServiceInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

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
    public function createContent($data): JsonResource
    {
        $content = $this->contentRepository->create($data);

        return new ContentResource($content);
    }

    public function contentDeleteByUrl(string $url): int
    {
        $deletedContent = $this->contentRepository->contentDeleteByUrl($url);

        return $deletedContent;
    }

    public function getContentList(Request $request): LengthAwarePaginator
    {
        $contents = $this->contentRepository->paginate($request);

        return $contents;
    }

    /**
     * @param string $hashTag
     * @return Collection|null
     * @throws Exception
     */
    public function getAllContentByHashTag(string $hashTag)
    {
        try {

            $hash = explode(',',trim($hashTag));

            $hash = array_map(function($item){

                return trim($item);
            }, $hash);

            $contents = $this->contentRepository->getAllContentByHashTag($hash);

            return $contents;

        } catch (Exception $e) {

            throw new Exception('Invalid Hash Tag... Enter Valid HashTag with provided comma separator string');
        }

    }
}
