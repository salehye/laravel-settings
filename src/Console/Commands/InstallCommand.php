<?php

namespace YourVendor\WebSettings\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'web-settings:install';
    protected $description = 'Install the WebSettings package';

    public function handle(): void
    {
        $this->info('Installing WebSettings...');

        $this->publishConfiguration();
        $this->publishMigrations();

        $this->info('WebSettings installed successfully.');
    }

    private function publishConfiguration(): void
    {
        $this->call('vendor:publish', [
            '--provider' => "YourVendor\WebSettings\Providers\WebSettingsServiceProvider",
            '--tag' => 'web-settings-config',
        ]);
    }

    private function publishMigrations(): void
    {
        $this->call('vendor:publish', [
            '--provider' => "YourVendor\WebSettings\Providers\WebSettingsServiceProvider",
            '--tag' => 'web-settings-migrations',
        ]);
    }
}
