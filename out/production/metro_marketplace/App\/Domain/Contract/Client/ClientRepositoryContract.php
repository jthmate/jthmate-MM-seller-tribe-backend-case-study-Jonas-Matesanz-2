<?php

namespace App\Domain\Contract\Client;

use App\Domain\Entity\Client;
use App\Domain\ValueObject\Client\ClientId;

interface ClientRepositoryContract
{
    /**
     * @param ClientId $clientId
     * @return Client
     */
    public function find(ClientId $clientId): ?Client;
}
