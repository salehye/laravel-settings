<?php

use YourVendor\WebSettings\Support\Facades\Settings;

if (!function_exists('web_setting')) {
    /**
     * Get a web setting value or set a new one.
     *
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed|\YourVendor\WebSettings\Application\Services\SettingsService
     */
    function web_setting(?string $key = null, mixed $default = null)
    {
        if (is_null($key)) {
            return app('web-settings');
        }

        return Settings::get($key, $default);
    }
}
