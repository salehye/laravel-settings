<?php

namespace Salehye\LaravelSettings\Domain\ValueObjects;

class SettingType
{
    public const STRING = 'string';
    public const INTEGER = 'integer';
    public const BOOLEAN = 'boolean';
    public const ARRAY = 'array';
    public const JSON = 'json';
    public const FLOAT = 'float';

    private string $value;

    public function __construct(string $value = self::STRING)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function getAvailableTypes(): array
    {
        return [
            self::STRING,
            self::INTEGER,
            self::BOOLEAN,
            self::ARRAY ,
            self::JSON,
            self::FLOAT,
        ];
    }
}
