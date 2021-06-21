<?php

namespace App\Domain\ValueObject\Product;

final class ProductPrice
{
    private $value;

    public function __construct(int $price) {
        $this->validate($price);
        $this->value = $price;
    }

    public function value(): int
    {
        return $this->value;
    }

    private function validate(int $price): void {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($price, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', ProductPrice::class, $price)
            );
        }
    }
}