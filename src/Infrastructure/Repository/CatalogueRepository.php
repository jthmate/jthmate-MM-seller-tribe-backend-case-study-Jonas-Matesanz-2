<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Catalogue\CatalogueRepositoryContract;
use App\Domain\Entity\Catalogue;
use App\Domain\Entity\Product;
use App\Domain\ValueObject\Client\ClientId;
use App\Domain\ValueObject\Product\ProductId;
use App\Infrastructure\Repository\Doctrine\DoctrineRepository;

/**
 * Class CatalogueRepository
 * @package App\Infrastructure\Repository
 */
final class CatalogueRepository extends DoctrineRepository implements CatalogueRepositoryContract
{
    /**
     * @param Catalogue $catalogue
     * @return Catalogue
     */
    public function save(Catalogue $catalogue): Catalogue
    {
        $data = new Catalogue(
            $catalogue->client(),
            $catalogue->product(),
            $catalogue->price()
        );

        $this->persist($data);

        return $data;
    }

    /**
     * @param ClientId $clientId
     * @return array
     */
    public function findByClient(ClientId $clientId): array
    {
        return $this->repository(Catalogue::class)->findBy(['client' => $clientId->value()]);
    }

    /**
     * @param ProductId $productId
     * @return array
     */
    public function findByProduct(ProductId $productId): array
    {
        return $this->repository(Catalogue::class)->findBy(['product' => $productId->value()]);
    }

}
