<?php

namespace Robbin\EloquentValueObjects\Tests;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use Robbin\EloquentValueObjects\EloquentValueObjectsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setupDatabase();

        $this->withFactories(__DIR__.'/database/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            EloquentValueObjectsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_eloquent_value_objects_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }

    protected function setupDatabase()
    {
        $this->app['db']
            ->connection()
            ->getSchemaBuilder()
            ->create('test_models', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
            });
    }
}
