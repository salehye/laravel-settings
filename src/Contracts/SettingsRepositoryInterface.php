<?php

namespace YourVendor\WebSettings\Contracts;

use Illuminate\Support\Collection;
use YourVendor\WebSettings\Domain\Models\Setting;
use YourVendor\WebSettings\Domain\ValueObjects\SettingKey;

interface SettingsRepositoryInterface
{
    public function findByKey(SettingKey $key): ?Setting;

    public function updateOrCreate(SettingKey $key, array $data): Setting;

    public function delete(SettingKey $key): bool;

    public function all(): Collection;

    public function getByGroup(string $group): Collection;
}
