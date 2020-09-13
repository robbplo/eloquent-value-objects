<?php

namespace Robbin\EloquentValueObjects\Tests\TestClasses\DTO;

use Illuminate\Support\Str;
use Robbin\EloquentValueObjects\DTO\Value;

class Name extends Value
{
    public function toUpperCase()
    {
        return Str::upper($this->value);
    }

    protected static function isValid($value): bool
    {
        return strlen($value) <= 20;
    }
}
