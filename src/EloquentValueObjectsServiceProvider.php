<?php

namespace Robbin\EloquentValueObjects;

use Illuminate\Support\ServiceProvider;
use Robbin\EloquentValueObjects\Commands\EloquentValueObjectsCommand;

class EloquentValueObjectsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/eloquent-value-objects.php' => config_path('eloquent-value-objects.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/eloquent-value-objects'),
            ], 'views');

            $migrationFileName = 'create_eloquent_value_objects_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                EloquentValueObjectsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'eloquent-value-objects');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/eloquent-value-objects.php', 'eloquent-value-objects');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
