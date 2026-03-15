<?php

namespace Salehye\LaravelSettings\Application\UseCases;

use Salehye\LaravelSettings\Application\Services\SettingsService;

class GetSettingUseCase
{
    public function __construct(
        protected SettingsService $service
    ) {
    }

    public function execute(string $key, mixed $default = null): mixed
    {
        return $this->service->get($key, $default);
    }
}
