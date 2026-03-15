<?php

namespace Salehye\LaravelSettings\Infrastructure\Persistence\Repositories;

use Illuminate\Support\Collection;
use Salehye\LaravelSettings\Contracts\SettingsRepositoryInterface;
use Salehye\LaravelSettings\Domain\Models\Setting;
use Salehye\LaravelSettings\Domain\ValueObjects\SettingKey;

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
