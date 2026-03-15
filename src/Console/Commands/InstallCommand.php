<?php

namespace Salehye\LaravelSettings\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'web-settings:install';
    protected $description = 'Install the Salehye\LaravelSettings package';

    public function handle(): void
    {
        $this->info('Installing Salehye\LaravelSettings...');

        $this->publishConfiguration();
        $this->publishMigrations();

        $this->info('Salehye\LaravelSettings installed successfully.');
    }

    private function publishConfiguration(): void
    {
        $this->call('vendor:publish', [
            '--provider' => "Salehye\LaravelSettings\Providers\Salehye\LaravelSettingsServiceProvider",
            '--tag' => 'web-settings-config',
        ]);
    }

    private function publishMigrations(): void
    {
        $this->call('vendor:publish', [
            '--provider' => "Salehye\LaravelSettings\Providers\Salehye\LaravelSettingsServiceProvider",
            '--tag' => 'web-settings-migrations',
        ]);
    }
}
