<?php

namespace Salehye\LaravelSettings\Providers;

use Illuminate\Support\ServiceProvider;
use Salehye\LaravelSettings\Application\Services\SettingsService;
use Salehye\LaravelSettings\Contracts\SettingsRepositoryInterface;
use Salehye\LaravelSettings\Infrastructure\Persistence\Repositories\CachedSettingsRepository;
use Salehye\LaravelSettings\Infrastructure\Persistence\Repositories\EloquentSettingsRepository;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/web-settings.php', 'web-settings');

        $this->app->singleton(SettingsRepositoryInterface::class, function ($app) {
            return new CachedSettingsRepository(new EloquentSettingsRepository());
        });

        $this->app->singleton('web-settings', function ($app) {
            return $app->make(SettingsService::class);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/web-settings.php' => config_path('web-settings.php'),
            ], 'web-settings-config');

            $this->publishes([
                __DIR__ . '/../../database/migrations' => database_path('migrations'),
            ], 'web-settings-migrations');

            $this->commands([
                \Salehye\LaravelSettings\Console\Commands\InstallCommand::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'web-settings');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'web-settings');
    }
}
