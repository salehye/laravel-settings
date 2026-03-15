<?php

namespace YourVendor\WebSettings\Tests\Unit;

use YourVendor\WebSettings\Domain\Exceptions\InvalidSettingKeyException;
use YourVendor\WebSettings\Domain\ValueObjects\SettingKey;
use YourVendor\WebSettings\Tests\TestCase;

class SettingKeyTest extends TestCase
{
    /** @test */
    public function it_can_be_created_with_a_valid_key(): void
    {
        $key = new SettingKey("app_name");
        $this->assertEquals("app_name", $key->getValue());
        $this->assertEquals("app_name", (string) $key);
    }

    /** @test */
    public function it_throws_exception_for_empty_key(): void
    {
        $this->expectException(InvalidSettingKeyException::class);
        new SettingKey("");
    }

    /** @test */
    public function it_throws_exception_for_invalid_key_format(): void
    {
        $this->expectException(InvalidSettingKeyException::class);
        new SettingKey("app-name!");
    }
}
