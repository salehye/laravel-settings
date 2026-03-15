<?php

namespace YourVendor\WebSettings\Application\DTOs;

use YourVendor\WebSettings\Domain\Models\Setting;
use YourVendor\WebSettings\Domain\ValueObjects\SettingKey;
use YourVendor\WebSettings\Domain\ValueObjects\SettingType;
use YourVendor\WebSettings\Domain\ValueObjects\SettingValue;

class SettingData
{
    public function __construct(
        public readonly string $key,
        public readonly mixed $value,
        public readonly string $type = SettingType::STRING,
        public readonly ?string $group = null,
        public readonly ?string $description = null
    ) {}

    public static function fromModel(Setting $setting): self
    {
        $settingType = new SettingType($setting->type);
        $settingValue = new SettingValue($setting->value, $settingType);

        return new self(
            key: $setting->key,
            value: $settingValue->getValue(),
            type: $setting->type,
            group: $setting->group,
            description: $setting->description
        );
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
            'group' => $this->group,
            'description' => $this->description,
        ];
    }
}
