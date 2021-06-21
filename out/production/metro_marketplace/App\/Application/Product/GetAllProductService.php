<?php

namespace App\Application\Product;

use App\Domain\Contract\Product\ProductRepositoryContract;

class GetAllProductService
{
    /**
     * @var ProductRepositoryContract
     */
    private ProductRepositoryContract $repository;

    /**
     * GetAllProductService constructor.
     * @param ProductRepositoryContract $repository
     */
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return $this->repository->findAll();
    }

}