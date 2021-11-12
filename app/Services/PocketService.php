<?php

namespace App\Services;

use App\Http\Resources\PocketResource;
use App\Repositories\Contracts\PocketRepositoryInterface;
use App\Services\Contracts\PocketServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PocketService implements PocketServiceInterface
{
    /**
     * @var PocketRepositoryInterface
     */
    private $pocketRepository;

    /**
     * Create a new service instance.
     *
     * @param PocketRepositoryInterface $pocketRepository
     * @return void
     */
    public function __construct(PocketRepositoryInterface $pocketRepository)
    {
        $this->pocketRepository = $pocketRepository;
    }


    public function getPocketList($perPage): LengthAwarePaginator
    {
        return $this->pocketRepository->paginate(10);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function storePocket(array $data)
    {
        $pocket = $this->pocketRepository->create($data);

        return new PocketResource($pocket);
    }

    public function detailsPocketById(int $pocketId): ?Collection
    {
        $pocket = $this->pocketRepository->detailsPocketById($pocketId);

        return $pocket;
    }

    /**
     * @param int $pocketId
     * @return bool|null
     */
    public function deletePocketById(int $pocketId)
    {
        return $this->pocketRepository->delete($pocketId);

    }
}
