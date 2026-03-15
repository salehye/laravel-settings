<?php

namespace YourVendor\WebSettings\Providers;

use Illuminate\Support\ServiceProvider;
use YourVendor\WebSettings\Application\Services\SettingsService;
use YourVendor\WebSettings\Contracts\SettingsRepositoryInterface;
use YourVendor\WebSettings\Infrastructure\Persistence\Repositories\CachedSettingsRepository;
use YourVendor\WebSettings\Infrastructure\Persistence\Repositories\EloquentSettingsRepository;

class WebSettingsServiceProvider extends ServiceProvider
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
                \YourVendor\WebSettings\Console\Commands\InstallCommand::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'web-settings');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'web-settings');
    }
}
