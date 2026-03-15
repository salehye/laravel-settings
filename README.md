# Salehye\LaravelSettings Laravel Package

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MIT License](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)

Salehye\LaravelSettings is a comprehensive Laravel package designed for flexible, extensible, multi-language, and enterprise-ready management of website settings. It provides a robust architecture based on Domain-Driven Design (DDD) principles, ensuring maintainability and scalability for your Laravel applications.

## Features

- **Flexible**: Easily define and manage various types of settings (string, integer, boolean, array, JSON, float).
- **Extensible**: Designed with interfaces and services, allowing for easy customization and extension of core functionalities like caching and validation.
- **Multi-language Support**: Built-in support for translating setting descriptions and values.
- **Enterprise-ready**: Follows best practices for Laravel package development, including migrations, configuration, commands, and API endpoints.
- **Caching**: Integrated caching mechanism to optimize performance for frequently accessed settings.
- **Validation**: Custom validation rules can be defined for settings.
- **Artisan Commands**: Convenient Artisan commands for installation and management.
- **API Endpoints**: RESTful API for programmatic access and management of settings.
- **Facade & Helper**: Easy access to settings via a Facade and a global helper function.

## Installation

You can install the package via Composer:

```bash
composer require your-vendor/web-settings
```

After installing the package, you can publish its configuration and run the migrations using the `web-settings:install` Artisan command:

```bash
php artisan web-settings:install
```

This command will:

- Publish the `web-settings.php` configuration file to your `config` directory.
- Publish the migration file to your `database/migrations` directory.
- Run the migrations to create the `web_settings` table.

Alternatively, you can publish the files manually:

```bash
php artisan vendor:publish --provider="Salehye\LaravelSettings\Providers\Salehye\LaravelSettingsServiceProvider" --tag="web-settings-config"
php artisan vendor:publish --provider="Salehye\LaravelSettings\Providers\Salehye\LaravelSettingsServiceProvider" --tag="web-settings-migrations"
php artisan migrate
```

## Configuration

The `config/web-settings.php` file allows you to customize various aspects of the package:

```php
// config/web-settings.php
return [
    'table_name' => 'web_settings',
    'cache' => [
        'enabled' => env('WEB_SETTINGS_CACHE_ENABLED', true),
        'duration' => env('WEB_SETTINGS_CACHE_DURATION', 60),
        'prefix' => env('WEB_SETTINGS_CACHE_PREFIX', 'web_settings_'),
    ],
    'validation' => [
        'rules' => [
            // 'app_name' => 'required|string|max:255',
        ],
    ],
    'defaults' => [
        // ['key' => 'app_name', 'value' => 'My Laravel App', 'type' => 'string', 'group' => 'general', 'description' => 'The name of the application'],
    ],
    'web_middleware' => ['web', 'auth'],
    'api_middleware' => ['api', 'auth:sanctum'],
    'localization' => [
        'enabled' => env('WEB_SETTINGS_LOCALIZATION_ENABLED', false),
        'locales' => ['en', 'ar'],
        'default_locale' => 'en',
    ],
];
```

## Usage

### Getting Settings

You can retrieve settings using the `Settings` Facade or the `web_setting()` helper function:

```php
// Using the Facade
use Salehye\LaravelSettings\Support\Facades\Settings;

$appName = Settings::get('app_name', 'Default App Name');

// Using the helper function
$contactEmail = web_setting('contact_email', 'info@example.com');

// Get all settings
$allSettings = Settings::all();
```

### Setting/Updating Settings

```php
// Using the Facade
Settings::set('app_name', 'My New App Name', 'string', 'general', 'Updated application name');

// Using the helper function (if you need to set, call without arguments first)
web_setting()->set('contact_email', 'new_info@example.com', 'email', 'contact');
```

### Deleting Settings

```php
Settings::forget('old_setting_key');
```

### API Endpoints

The package provides the following API endpoints (prefixed with `/api/web-settings`):

| Method   | URI      | Action    | Middleware            |
| :------- | :------- | :-------- | :-------------------- |
| `GET`    | `/`      | `index`   | `api`, `auth:sanctum` |
| `GET`    | `/{key}` | `show`    | `api`, `auth:sanctum` |
| `PUT`    | `/{key}` | `update`  | `api`, `auth:sanctum` |
| `DELETE` | `/{key}` | `destroy` | `api`, `auth:sanctum` |

Example API usage with `PUT` request:

```bash
curl -X PUT \
  http://your-app.com/api/web-settings/app_name \
  -H 'Accept: application/json' \
  -H 'Authorization: Bearer YOUR_SANCTUM_TOKEN' \
  -H 'Content-Type: application/json' \
  -d '{
    "value": "My Updated App",
    "type": "string",
    "group": "general",
    "description": "The updated name of the application"
  }'
```

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## License

The Salehye\LaravelSettings Laravel Package is open-sourced software licensed under the [MIT license](LICENSE.md).
