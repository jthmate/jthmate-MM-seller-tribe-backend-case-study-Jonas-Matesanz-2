<?php

namespace App\Domain\Event;

use App\Domain\Entity\Product;

/**
 * Class ProductCreatedEvent
 * @package App\Domain\Event
 */
class ProductCreatedEvent
{
    /**
     * @var Product
     */
    private Product $product;

    /**
     * ProductCreatedEvent constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function value(): Product
    {
        return $this->product;
    }
}