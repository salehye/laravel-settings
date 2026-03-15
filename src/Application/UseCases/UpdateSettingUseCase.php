<?php

namespace YourVendor\WebSettings\Application\UseCases;

use YourVendor\WebSettings\Application\DTOs\SettingData;
use YourVendor\WebSettings\Application\Services\SettingsService;

class UpdateSettingUseCase
{
    public function __construct(
        protected SettingsService $service
    ) {}

    public function execute(string $key, mixed $value, ?string $type = null, ?string $group = null, ?string $description = null): SettingData
    {
        return $this->service->set($key, $value, $type, $group, $description);
    }
}
