<?php

use Robbin\EloquentValueObjects\DTO\Value;
use Robbin\EloquentValueObjects\Exceptions\DTOException;
use Robbin\EloquentValueObjects\Tests\TestClasses\TestModel;

beforeEach(function () {
    $this->model = TestModel::create([
        'name' => 'Piet',
    ]);
});

it('casts a model attribute to a value', function () {
    expect($this->model->name)
        ->toBeInstanceOf(Value::class);

    expect($this->model->name->toUpperCase())
        ->toEqual('PIET');
});

it('throws an exception when assigning invalid values', function () {
    $this->expectException(DTOException::class);

    $this->model->name = 'A string longer than twenty characters';
});
