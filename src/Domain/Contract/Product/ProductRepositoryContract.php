<?php

namespace App\Domain\Contract\Product;

use App\Domain\Entity\Product;
use App\Domain\ValueObject\Product\ProductId;

interface ProductRepositoryContract
{
    /**
     * @param ProductId $id
     * @return Product|null
     */
    public function find(ProductId $id): ?Product;

    /**
     * @param Product $product
     * @return Product
     */
    public function save(Product $product): Product;

    /**
     * @param ProductId $productId
     * @param Product $product
     */
    public function update(ProductId $productId, Product $product): void;

    /**
     * @param ProductId $productId
     */
    public function delete(ProductId $productId): void;
}
