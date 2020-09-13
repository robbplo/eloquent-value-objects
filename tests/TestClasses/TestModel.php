<?php

namespace Robbin\EloquentValueObjects\Tests\TestClasses;

use Illuminate\Database\Eloquent\Model;
use Robbin\EloquentValueObjects\HasValueObjects;
use Robbin\EloquentValueObjects\Tests\TestClasses\DTO\Name;

class TestModel extends Model
{
    use HasValueObjects;

    protected $guarded = [];

    protected $casts = [
        'name' => Name::class,
    ];
}
