<?php

namespace App\Application\Catalogue;

use App\Domain\Contract\Catalogue\CatalogueRepositoryContract;
use App\Domain\ValueObject\Product\ProductId;

class GetAllOffersByProductService
{
    /**
     * @var CatalogueRepositoryContract
     */
    private $repository;

    /**
     * GetAllOffersByProductService constructor.
     * @param CatalogueRepositoryContract $repository
     */
    public function __construct(CatalogueRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return array
     */
    public function __invoke(int $id): array
    {
        $productId = new ProductId($id);

        return $this->repository->findByProduct($productId);
    }

}