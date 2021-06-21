<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Product\ProductId;
use App\Domain\ValueObject\Product\ProductName;
use App\Domain\ValueObject\Product\ProductPrice;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Client
 * @ORM\Entity
 * @ORM\Table(name="client")
 */
class Client
{
    /**
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="name", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="email", length=255, nullable=false)
     */
    private $email;

    /**
     * Client constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     */
    public function __construct(int $id, string $name, string $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @return Client
     */
    public static function create(int $id, string $name, string $email): Client
    {
        return new self($id, $name, $email);
    }
}