<?php

namespace Robbin\EloquentValueObjects\DTO;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class Caster implements CastsAttributes
{
    private static array $cache;

    private string $class;

    public function __construct(string $class)
    {
        if (! class_exists($class)) {
            throw new InvalidArgumentException('Target class does not exist');
        }

        $this->class = $class;
    }

    /**
     * Convert from database column value to cast instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $readValue
     * @param array $attributes
     * @return mixed
     */
    public function get($model, string $key, $readValue, array $attributes)
    {
        return $this->toObject($readValue);
    }

    /**
     * Convert from cast instance to database column value.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $writeValue
     * @param array $attributes
     * @return mixed
     */
    public function set($model, string $key, $writeValue, array $attributes)
    {
        return $this->toValue($writeValue);
    }

    /**
     * Instantiate value into a value object.
     *
     * @param $value
     * @return mixed
     */
    private function toObject($value)
    {
        return $this->cache(new $this->class($value));
    }

    /**
     * @param $object
     * @return mixed
     */
    private function toValue($object)
    {
        if (is_scalar($object)) {
            $object = new $this->class($object);
        }

        if ($object instanceof Value) {
            return $object->toScalar();
        }

        $value = data_get($object, '*');

        if (! is_scalar($value)) {
            return null;
        }

        return $value;
    }

    private function cache($value)
    {
        $key = (string) $this->toValue($value);

        static::$cache[$this->class][$key] ??= $value;

        return static::$cache[$this->class][$key];
    }
}

