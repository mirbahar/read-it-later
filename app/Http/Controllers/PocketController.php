<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletedPocketRequest;
use App\Http\Requests\PocketRequest;
use App\Services\Contracts\PocketServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
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
     * @param $perPage
     * @return LengthAwarePaginator
     */
    public function index($perPage = null)
    {
        $pockets =  $this->pocketService->getPocketPocketsWithContentList($perPage);

        return view('pockets.list', compact('pockets'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PocketRequest $request
     * @return Response
     */
    public function store(PocketRequest $request)
    {
        return $this->pocketService->storePocket([
            'title' => $request->title,
        ]);
    }


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
