<?php

namespace YourVendor\WebSettings\Infrastructure\Persistence\Repositories;

use Illuminate\Support\Collection;
use YourVendor\WebSettings\Contracts\SettingsRepositoryInterface;
use YourVendor\WebSettings\Domain\Models\Setting;
use YourVendor\WebSettings\Domain\ValueObjects\SettingKey;

class EloquentSettingsRepository implements SettingsRepositoryInterface
{
    protected string $model;

    public function __construct()
    {
        $this->model = Setting::class;
    }

    public function findByKey(SettingKey $key): ?Setting
    {
        return $this->model::where('key', $key->getValue())->first();
    }

    public function updateOrCreate(SettingKey $key, array $data): Setting
    {
        return $this->model::updateOrCreate(
            ['key' => $key->getValue()],
            $data
        );
    }

    public function delete(SettingKey $key): bool
    {
        return (bool) $this->model::where('key', $key->getValue())->delete();
    }

    public function all(): Collection
    {
        return $this->model::all();
    }

    public function getByGroup(string $group): Collection
    {
        return $this->model::ofGroup($group)->get();
    }
}
