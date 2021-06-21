<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Product\ProductRepositoryContract;
use App\Domain\Entity\Product;
use App\Domain\ValueObject\Product\ProductId;
use App\Infrastructure\Repository\Doctrine\DoctrineRepository;

/**
 * Class ProductRepository
 * @package App\Infrastructure\Repository
 */
final class ProductRepository extends DoctrineRepository implements ProductRepositoryContract
{
    /**
     * @param Object $product
     * @return Product
     */
    public function save(Object $product): Product
    {
        $data = new Product(
            $product->id(),
            $product->name(),
            $product->price()
        );

        $this->persist($data);

        return $data;
    }

    /**
     * @param ProductId $productId
     * @param Product $product
     */
    public function update(ProductId $productId, Product $product): void
    {
        $productToUpdate = $this->find($productId);

        if (!$productToUpdate) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $product = new Product(
            $product->name(),
            $product->price()
        );

        $this->persist($product);
        $this->entityManager()->flush();
    }

    /**
     * @param ProductId $productId
     * @return Product|null
     */
    public function find(ProductId $productId): ?Product
    {
        return $this->repository(Product::class)->find($productId->value());
    }

    /**
     * @param ProductId $productId
     */
    public function delete(ProductId $productId): void
    {
        $product = $this->find($productId);

        $this->remove($product);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->repository(Product::class)->findAll();
    }
}
