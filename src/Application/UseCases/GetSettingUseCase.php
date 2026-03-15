<?php

namespace YourVendor\WebSettings\Application\UseCases;

use YourVendor\WebSettings\Application\Services\SettingsService;

class GetSettingUseCase
{
    public function __construct(
        protected SettingsService $service
    ) {}

    public function execute(string $key, mixed $default = null): mixed
    {
        return $this->service->get($key, $default);
    }
}
