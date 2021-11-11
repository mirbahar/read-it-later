<?php

namespace App\Services;

use App\Http\Resources\ContentResource;
use App\Http\Resources\TagResource;
use App\Repositories\Contracts\ContentRepositoryInterface;
use App\Repositories\Contracts\PocketRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Services\Contracts\ContentServiceInterface;
use App\Services\Contracts\TagServiceInterface;

class TagService implements TagServiceInterface
{
    /**
     * @var TagRepositoryInterface
     */
    private $tagRepository;

    /**
     * Create a new service instance.
     *
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createTags($data)
    {
        $tags = [];

        $hashTags = $this->hashTagGeneratedFromUrl($data->url);

       if(empty($hashTags)){
           return null;
       }

       $tag = [
           'content_id' => $data->id,
           'name'=> $hashTags
       ];

        $this->tagRepository->create($tag);

        return new TagResource($tags);
    }

    private function hashTagGeneratedFromUrl($url){

        preg_match_all('/#([^\s]+)/', $url, $matches);

        $hashtags = implode(',', $matches[1]);

       return $hashtags;
    }

    public function findByContent($contentId)
    {
        return $this->tagRepository->findByContent($contentId);
    }
}
