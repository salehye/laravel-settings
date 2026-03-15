<?php

namespace Salehye\LaravelSettings\Domain\Exceptions;

use Exception;

class SettingNotFoundException extends Exception
{
    public function __construct(string $key)
    {
        parent::__construct("Setting with key '{$key}' not found.");
    }
}
