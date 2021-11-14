<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentDeletedRequest;
use App\Http\Requests\ContentRequest;
use App\Services\Contracts\ContentServiceInterface;
use App\Services\Contracts\TagServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description"
 * )
 *
 */
class ContentController extends Controller
{
    /**
     * @var ContentServiceInterface
     */
    private $contentService;

    /**
     * @var TagServiceInterface
     */
    private $tagService;

    public function __construct(ContentServiceInterface $contentService, TagServiceInterface $tagService)
    {
        $this->contentService = $contentService;
        $this->tagService     = $tagService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/contents",
     *      operationId="Get Content listing",
     *      tags={"Content"},
     *      summary="Get All Contents",
     *      description="Get all Contents",
     *      @OA\RequestBody(
     *          description="Pass page nubmer",
     *          @OA\JsonContent(
     *                  @OA\Property(property="perPage", type="int", example=1),
     *                  @OA\Property(property="columns", type="[]", example = null),
     *                  @OA\Property(property="pageName", type="string", example=null),
     *                  @OA\Property(property="page", type="string", example=null),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     * )
     * Display a listing of the Pockets.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        return $this->contentService->getContentList($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/hashTag",
     *      operationId="get All Content By HashTag",
     *      tags={"Content"},
     *      summary="get all Content By HashTag",
     *      description="get all Content By HashTag",
     *      * @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *                  required={"hashTag"},
     *                  @OA\Property(property="hashTag", type="string", example="foo, the-config-directory, creating-and-dropping-tables"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     * )
     *
     * Store a newly created content in storage.
     * @param Request $request
     * @return Collection
     */
    public function getContentByHashTag(Request $request)
    {
        $hashTag = $request->get('hashTag');

        $contentList =  $this->contentService->getAllContentByHashTag($hashTag);

        return $contentList;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/contents",
     *      operationId="Create Content",
     *      tags={"Content"},
     *      summary="Create Content",
     *      description="Create content",
     *      * @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *                  required={"pocket_id","url"},
     *                  @OA\Property(property="pocket_id", type="int", example="1"),
     *                  @OA\Property(property="url", type="string", example="https://laravel.com/docs/8.x/testing"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     * )
     *
     * Store a newly created content in storage.
     * @param ContentRequest $request
     * @return JsonResource
     */
    public function store(ContentRequest $request)
    {
        $content = $this->contentService->createContent([
                'pocket_id' => $request->pocket_id,
                'url' => $request->url,
            ]);

        $this->tagService->createTags($content);

        return $content;
    }


    /**
     * @OA\Delete(
     *      path="/api/v1/contents",
     *      operationId="Delete Content By Url",
     *      tags={"Content"},
     *      summary="Delete Content",
     *      description="Delete content",
     *      * @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *                  required={"url"},
     *                  @OA\Property(property="url", type="string", example="www.facebook.com"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     * )
     *
     * Remove the specified resource from storage.
     * @param ContentDeletedRequest $request
     * @return Response
     */

    public function destroy(ContentDeletedRequest $request)
    {
        $url = $request->url;

        $deletedContent = $this->contentService->contentDeleteByUrl($url);

        if ($deletedContent === 0) {
            return response()->json('Content Not Found', 404);
        }

        return response()->json("Content has been deleted'", 200);
    }
}
