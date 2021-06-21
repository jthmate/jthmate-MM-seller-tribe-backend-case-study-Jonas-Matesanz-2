<?php

namespace App\Application\Product;

use App\Domain\Contract\Product\ProductRepositoryContract;
use App\Domain\Entity\Product;
use App\Domain\ValueObject\Product\ProductId;

class GetProductService
{
    private ProductRepositoryContract $repository;

    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Product
    {
        $productId = new ProductId($id);

        $product = $this->repository->find($productId);

        return $product;
    }

}