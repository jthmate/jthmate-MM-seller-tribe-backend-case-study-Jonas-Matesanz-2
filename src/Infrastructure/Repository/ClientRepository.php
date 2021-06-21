<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Client\ClientRepositoryContract;
use App\Domain\Entity\Client;
use App\Domain\ValueObject\Client\ClientId;
use App\Infrastructure\Repository\Doctrine\DoctrineRepository;

/**
 * Class ClientRepository
 * @package App\Infrastructure\Repository
 */
final class ClientRepository extends DoctrineRepository implements ClientRepositoryContract
{

    /**
     * @param ClientId $clientId
     * @return Client|null
     */
    public function find(ClientId $clientId): ?Client
    {
        return $this->repository(Client::class)->find($clientId->value());
    }
}
