<?php

namespace Robbin\EloquentValueObjects\Tests;

use Robbin\EloquentValueObjects\DTO\Value;
use Robbin\EloquentValueObjects\Exceptions\DTOException;
use Robbin\EloquentValueObjects\Tests\TestClasses\TestModel;

class CastingTest extends TestCase
{
    /** @test */
    public function model_casts_attribute_to_value()
    {
        $model = TestModel::create([
            'name' => 'Piet',
        ]);

        $this->assertInstanceOf(Value::class, $model->name);
        $this->assertEquals('PIET', $model->name->toUpperCase());
    }

    /** @test */
    public function model_rejects_invalid_values()
    {
        $model = new TestModel;

        // @todo make sure the message is descriptive of the model context
        $this->expectException(DTOException::class);

        $model->name = 'A string longer than twenty characters';
    }
}
