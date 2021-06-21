<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Product\ProductId;
use App\Domain\ValueObject\Product\ProductName;
use App\Domain\ValueObject\Product\ProductPrice;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     *
     * @ORM\Column(type="string", name="name", length=255, nullable=false)
     */
    private string $name;

    /**
     *
     * @ORM\Column(type="integer", name="price", nullable=false, options={"unsigned":true, "default":0})
     */
    private int $price;

    /**
     * Product constructor.
     * @param ProductId $productId
     * @param ProductName $productName
     * @param ProductPrice $productPrice
     */
    public function __construct(
        ProductId    $productId,
        ProductName  $productName,
        ProductPrice $productPrice
    )
    {
        $this->id    = $productId->value();
        $this->name  = $productName->value();
        $this->price = $productPrice->value();
    }

    /**
     * @return ProductId
     */
    public function id(): ProductId
    {
        return new ProductId($this->id);
    }

    /**
     * @return ProductName
     */
    public function name(): ProductName
    {
        return new ProductName($this->name);
    }

    /**
     * @return ProductPrice
     */
    public function price(): ProductPrice
    {
        return new ProductPrice($this->price);
    }

    /**
     * @param ProductId $id
     * @param ProductName $name
     * @param ProductPrice $price
     * @return Product
     */
    public static function create(ProductId $id, ProductName $name, ProductPrice $price): Product
    {
        return new self($id, $name, $price);
    }
}