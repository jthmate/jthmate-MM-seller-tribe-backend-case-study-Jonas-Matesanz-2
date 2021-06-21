<?php

namespace App\Domain\Event;

use App\Domain\ValueObject\Product\ProductName;
use App\Domain\ValueObject\Product\ProductPrice;

/**
 * Class Product
 * @package App\Domain\Event
 */
class Product
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $price;
}