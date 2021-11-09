<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface PocketServiceInterface
{

    public function getPocketList(): array ;

    public function storePocket(array $data);
}