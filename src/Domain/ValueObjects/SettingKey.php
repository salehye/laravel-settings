<?php

namespace YourVendor\WebSettings\Domain\ValueObjects;

use YourVendor\WebSettings\Domain\Exceptions\InvalidSettingKeyException;

class SettingKey
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidSettingKeyException("Setting key cannot be empty.");
        }

        // Add more validation if needed, e.g., regex for valid characters
        if (!preg_match('/^[a-z0-9_.]+$/i', $value)) {
            throw new InvalidSettingKeyException("Invalid setting key format: {$value}. Use alphanumeric, underscore, and dots only.");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
