<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletedPocketRequest;
use App\Http\Requests\PocketRequest;
use App\Services\Contracts\PocketServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class PocketController extends Controller
{
    /**
     * @var PocketServiceInterface
    */
    private $pocketService;

    public function __construct(PocketServiceInterface $pocketService)
    {
        $this->pocketService = $pocketService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $pockets =  $this->pocketService->getPocketsWithContentList($request);

        return view('pockets.list', compact('pockets'));

    }

    /**
     * @OA\Post(
     *      path="/api/v1/pockets",
     *      operationId="Create Pocket",
     *      tags={"Pocket"},
     *      summary="Create Pocket",
     *      * @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *                  required={"title"},
     *                  @OA\Property(property="title", type="string", example="Pocket One"),
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
     * Store a newly created pocket in storage.
     * @param PocketRequest $request
     * @return Response
     */
    public function store(PocketRequest $request)
    {
        return $this->pocketService->storePocket([
            'title' => $request->title,
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/pockets",
     *      operationId="Show Pocket",
     *      tags={"Pocket"},
     *      summary="Show Pocket",
     *      description="Detail Pocket",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *                  @OA\Property(property="id", type="int", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     * )
     * Display a listing of the Pockets.
     *
     * @param DeletedPocketRequest $request
     * @return Collection|null
     */
    public function show(DeletedPocketRequest $request): ?Collection
    {
        $id = $request->id;

        return $this->pocketService->detailsPocketById($id);
    }

    public function destroy(int $id): JsonResponse
    {
        $pocketRow = $this->pocketService->deletePocketById($id);

        if ($pocketRow === 0) {

            return response()->json("Pocket id not found", 404);
        }

        return response()->json('Pocket has been deleted', 200);

    }
}
