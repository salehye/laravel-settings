<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Web Settings Table Name
    |--------------------------------------------------------------------------
    |
    | This value determines the table name used to store web settings.
    |
    */
    'table_name' => 'web_settings',

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Here you may configure the cache settings for your web settings.
    | 'enabled' determines if caching is active.
    | 'duration' is the number of minutes to cache settings.
    | 'prefix' is used to prevent cache key collisions.
    |
    */
    'cache' => [
        'enabled' => env('WEB_SETTINGS_CACHE_ENABLED', true),
        'duration' => env('WEB_SETTINGS_CACHE_DURATION', 60),
        'prefix' => env('WEB_SETTINGS_CACHE_PREFIX', 'web_settings_'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    |
    | Define custom validation rules for your settings. You can add rules
    | for specific setting keys or types.
    |
    */
    'validation' => [
        'rules' => [
            // 'app_name' => 'required|string|max:255',
            // 'contact_email' => 'required|email',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | These settings will be seeded into the database when the package is installed.
    | They serve as initial values for your application's web settings.
    |
    */
    'defaults' => [
        // ['key' => 'app_name', 'value' => 'My Laravel App', 'type' => 'string', 'group' => 'general', 'description' => 'The name of the application'],
        // ['key' => 'contact_email', 'value' => 'info@example.com', 'type' => 'email', 'group' => 'contact', 'description' => 'Contact email address'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware for Web Routes
    |--------------------------------------------------------------------------
    |
    | You can define middleware to be applied to the package's web routes.
    | This is useful for authentication or authorization.
    |
    */
    'web_middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Middleware for API Routes
    |--------------------------------------------------------------------------
    |
    | You can define middleware to be applied to the package's API routes.
    | This is useful for API authentication or rate limiting.
    |
    */
    'api_middleware' => ['api', 'auth:sanctum'],

    /*
    |--------------------------------------------------------------------------	
    | Localization Settings
    |--------------------------------------------------------------------------
    |
    | Configure settings related to multi-language support.
    | 'enabled' determines if multi-language features are active.
    |
    */
    'localization' => [
        'enabled' => env('WEB_SETTINGS_LOCALIZATION_ENABLED', false),
        'locales' => ['en', 'ar'], // Add more locales as needed
        'default_locale' => 'en',
    ],
];
