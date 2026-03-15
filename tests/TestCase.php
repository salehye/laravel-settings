<?php

namespace Salehye\LaravelSettings\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Salehye\LaravelSettings\Providers\Salehye\LaravelSettingsServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [Salehye\LaravelSettingsServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app["config"]->set("database.default", "testbench");
        $app["config"]->set("database.connections.testbench", [
            "driver" => "sqlite",
            "database" => ":memory:",
            "prefix" => "",
        ]);
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
