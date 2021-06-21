<?php

namespace App\Application\Client;

use App\Domain\Contract\Client\ClientRepositoryContract;
use App\Domain\Entity\Client;
use App\Domain\ValueObject\Client\ClientId;

class GetClientService
{
    private ClientRepositoryContract $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Client
    {
        $clientId = new ClientId($id);

        return $this->repository->find($clientId);
    }

}