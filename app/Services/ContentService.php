<?php

namespace App\Services;

use App\Http\Resources\ContentResource;
use App\Repositories\Contracts\ContentRepositoryInterface;
use App\Repositories\Contracts\PocketRepositoryInterface;
use App\Services\Contracts\ContentServiceInterface;

class ContentService implements ContentServiceInterface
{
    /**
     * @var PocketRepositoryInterface
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
    public function createPocket($data)
    {
        $content = $this->contentRepository->create($data);
        return new ContentResource($content);
    }
}
