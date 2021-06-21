<?php

namespace App\Domain\Event;

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

    /**
     * @return int
     */
    public function id(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string {
        return $this->name;
    }

    /**
     * @return int
     */
    public function price(): int {
        return $this->price;
    }
}