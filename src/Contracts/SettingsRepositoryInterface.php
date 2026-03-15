<?php

namespace Salehye\LaravelSettings\Contracts;

use Illuminate\Support\Collection;
use Salehye\LaravelSettings\Domain\Models\Setting;
use Salehye\LaravelSettings\Domain\ValueObjects\SettingKey;

interface SettingsRepositoryInterface
{
    public function findByKey(SettingKey $key): ?Setting;

    public function updateOrCreate(SettingKey $key, array $data): Setting;

    public function delete(SettingKey $key): bool;

    public function all(): Collection;

    public function getByGroup(string $group): Collection;
}
