<?php

namespace App\Domain\Contract\Catalogue;

use App\Domain\ValueObject\Client\ClientId;
use App\Domain\ValueObject\Product\ProductId;

interface CatalogueRepositoryContract
{
    /**
     * @param ClientId $clientId
     * @return array
     */
    public function findByClient(ClientId $clientId): array;

    /**
     * @param ProductId $productId
     * @return array
     */
    public function findByProduct(ProductId $productId): array;
}
