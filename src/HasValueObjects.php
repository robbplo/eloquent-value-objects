<?php

namespace Robbin\EloquentValueObjects;

use Robbin\EloquentValueObjects\Exceptions\DTOException;

trait HasValueObjects
{
    protected function setClassCastableAttribute($key, $value)
    {
        try {
            parent::setClassCastableAttribute($key, $value);
        } catch (DTOException $exception) {
            throw new DTOException("Invalid value passed to [{$key}] property: [{$value}]");
        }
    }
}
