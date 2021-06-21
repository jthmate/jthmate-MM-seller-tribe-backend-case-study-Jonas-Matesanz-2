<?php

namespace App\Domain\ValueObject\Client;

use InvalidArgumentException;

final class ClientId
{
    /**
     * @var int
     */
    private int $value;

    /**
     * ClientId constructor.
     * @param int $id
     */
    public function __construct(int $id) {
        $this->validate($id);
        $this->value = $id;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param int $id
     */
    private function validate(int $id): void {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', ClientId::class, $id)
            );
        }
    }
}