<?php

namespace Robbin\EloquentValueObjects\DTO;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Robbin\EloquentValueObjects\Exceptions\DTOException;

abstract class Value implements Castable
{
    protected $value;

    public function __construct($value)
    {
        $this->set($value);
    }

    public function toScalar()
    {
        return $this->get();
    }

    public function get()
    {
        return $this->value;
    }

    final protected function set($value): void
    {
        if (! static::isValid($value)) {
            throw new DTOException('Invalid value object');
        }

        $this->value = $value;
    }

    protected static function isValid($value): bool
    {
        return is_scalar($value);
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new Caster(static::class);
    }
}
