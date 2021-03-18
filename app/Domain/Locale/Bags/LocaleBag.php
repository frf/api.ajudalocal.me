<?php

namespace Domain\Locale\Bags;

/**
 * @property mixed name
 * @property mixed instructions
 * @property mixed about
 * @property mixed type
 * @property mixed latitude
 * @property mixed longitude
 * @property mixed address
 */
class LocaleBag
{
    private array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public static function fromRequest($attributes)
    {
        return new self($attributes);
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function __set($name, $value)
    {
        return $this->attributes[$name] = $value;
    }
}
