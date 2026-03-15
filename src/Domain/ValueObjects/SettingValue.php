<?php

namespace Salehye\LaravelSettings\Domain\ValueObjects;

class SettingValue
{
    private mixed $value;
    private SettingType $type;

    public function __construct(mixed $value, SettingType $type)
    {
        $this->value = $this->castValue($value, $type);
        $this->type = $type;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getType(): SettingType
    {
        return $this->type;
    }

    private function castValue(mixed $value, SettingType $type): mixed
    {
        switch ($type->getValue()) {
            case SettingType::INTEGER:
                return (int) $value;
            case SettingType::FLOAT:
                return (float) $value;
            case SettingType::BOOLEAN:
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case SettingType::ARRAY:
            case SettingType::JSON:
                return is_string($value) ? json_decode($value, true) : (array) $value;
            case SettingType::STRING:
            default:
                return (string) $value;
        }
    }

    public function __toString(): string
    {
        return is_array($this->value) ? json_encode($this->value) : (string) $this->value;
    }
}
