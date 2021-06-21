<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Class Catalogue
 * @ORM\Entity
 * @ORM\Table(name="catalogue")
 */
class Catalogue
{
    /**
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     *
     * @var int
     *
     * @ORM\Column(type="integer", name="price", nullable=true, options={"unsigned":true})
     */
    private int $price;

    /**
     *
     * @var Client
     *
     * @ManyToOne(targetEntity="Client", fetch="EAGER")
     * @JoinColumn(name="client_id", referencedColumnName="id")
     */
    private Client $client;

    /**
     *
     * @var Product
     *
     * @ManyToOne(targetEntity="Product", fetch="EAGER")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    private Product $product;


    /**
     * Catalogue constructor.
     * @param Client $client
     * @param Product $product
     * @param int $price
     */
    public function __construct(Client $client, Product $product, int $price)
    {
        $this->client  = $client;
        $this->product = $product;
        $this->price   = $price;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function client(): Client
    {
        return $this->client;
    }

    /**
     * @return Product
     */
    public function product(): Product
    {
        return  $this->product;
    }

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price;
    }

    /**
     * @param Client $client
     * @param Product $product
     * @param int $price
     * @return Catalogue
     */
    public static function create(Client $client, Product $product, int $price): Catalogue
    {
        return new self($client, $product, $price);
    }
}