<?php

namespace App\Http\Controllers;

use App\Http\Requests\PocketRequest;
use App\Services\Contracts\PocketServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
     * @param $perPage
     * @return LengthAwarePaginator
     */
    public function index($perPage = null)
    {
        return $this->pocketService->getPocketList($perPage);
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

    public function show(int $id): ?Collection
    {
        return $this->pocketService->detailsPocketById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $pocketRow = $this->pocketService->deletePocketById($id);
;
        if (is_null($pocketRow)) {
            return response()->json("Pocket id not found", 404);
        }

        return response()->json('Pocket has been deleted', 200);

    }
}
