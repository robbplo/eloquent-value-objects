<?php

namespace Robbin\EloquentValueObjects;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Robbin\EloquentValueObjects\EloquentValueObjects
 */
class EloquentValueObjectsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'eloquent-value-objects';
    }
}
