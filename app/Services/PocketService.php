<?php

namespace App\Services;

use App\Http\Resources\PocketResource;
use App\Repositories\Contracts\PocketRepositoryInterface;
use App\Services\Contracts\PocketServiceInterface;

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

    /**
     * @return mixed
     */
    public function getPocketList(): array
    {
        return $this->pocketRepository->all();
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
}
