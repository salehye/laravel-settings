<?php

namespace Salehye\LaravelSettings\Application\Services;

use Salehye\LaravelSettings\Application\DTOs\SettingData;
use Salehye\LaravelSettings\Contracts\SettingsRepositoryInterface;
use Salehye\LaravelSettings\Domain\Events\SettingUpdated;
use Salehye\LaravelSettings\Domain\ValueObjects\SettingKey;
use Salehye\LaravelSettings\Domain\ValueObjects\SettingType;
use Salehye\LaravelSettings\Domain\ValueObjects\SettingValue;

class SettingsService
{
    public function __construct(
        protected SettingsRepositoryInterface $repository
    ) {
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $setting = $this->repository->findByKey(new SettingKey($key));

        if (!$setting) {
            return $default;
        }

        $type = new SettingType($setting->type);
        $value = new SettingValue($setting->value, $type);

        return $value->getValue();
    }

    public function set(string $key, mixed $value, ?string $type = null, ?string $group = null, ?string $description = null): SettingData
    {
        $settingKey = new SettingKey($key);
        $settingType = new SettingType($type ?? $this->detectType($value));
        $settingValue = new SettingValue($value, $settingType);

        $setting = $this->repository->updateOrCreate($settingKey, [
            'value' => (string) $settingValue,
            'type' => $settingType->getValue(),
            'group' => $group,
            'description' => $description,
        ]);

        event(new SettingUpdated($setting));

        return SettingData::fromModel($setting);
    }

    public function forget(string $key): bool
    {
        return $this->repository->delete(new SettingKey($key));
    }

    public function all(): array
    {
        return $this->repository->all()->map(function ($setting) {
            return SettingData::fromModel($setting);
        })->toArray();
    }

    protected function detectType(mixed $value): string
    {
        if (is_int($value))
            return SettingType::INTEGER;
        if (is_float($value))
            return SettingType::FLOAT;
        if (is_bool($value))
            return SettingType::BOOLEAN;
        if (is_array($value))
            return SettingType::ARRAY;
        return SettingType::STRING;
    }
}
