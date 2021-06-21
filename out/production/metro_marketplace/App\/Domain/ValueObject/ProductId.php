<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;

final class ProductId
{
    private $value;

    public function __construct(int $id) {
        $this->validate($id);
        $this->value = $id;
    }

    public function value(): int
    {
        return $this->value;
    }

    private function validate(int $id): void {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', ProductId::class, $id)
            );
        }
    }
}