<?php

namespace Salehye\LaravelSettings\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed get(string $key, mixed $default = null)
 * @method static \Salehye\LaravelSettings\Application\DTOs\SettingData set(string $key, mixed $value, ?string $type = null, ?string $group = null, ?string $description = null)
 * @method static bool forget(string $key)
 * @method static array all()
 * 
 * @see \Salehye\LaravelSettings\Application\Services\SettingsService
 */
class Settings extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'web-settings';
    }
}
