<?php

namespace YourVendor\WebSettings\Infrastructure\Persistence\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use YourVendor\WebSettings\Contracts\SettingsRepositoryInterface;
use YourVendor\WebSettings\Domain\Models\Setting;
use YourVendor\WebSettings\Domain\ValueObjects\SettingKey;

class CachedSettingsRepository implements SettingsRepositoryInterface
{
    public function __construct(
        protected EloquentSettingsRepository $repository
    ) {}

    public function findByKey(SettingKey $key): ?Setting
    {
        if (!config('web-settings.cache.enabled')) {
            return $this->repository->findByKey($key);
        }

        $cacheKey = $this->getCacheKey($key->getValue());
        $duration = config('web-settings.cache.duration', 60);

        return Cache::remember($cacheKey, $duration, function () use ($key) {
            return $this->repository->findByKey($key);
        });
    }

    public function updateOrCreate(SettingKey $key, array $data): Setting
    {
        $setting = $this->repository->updateOrCreate($key, $data);
        
        if (config('web-settings.cache.enabled')) {
            Cache::forget($this->getCacheKey($key->getValue()));
            Cache::forget($this->getCacheKey('all_settings'));
        }

        return $setting;
    }

    public function delete(SettingKey $key): bool
    {
        $deleted = $this->repository->delete($key);

        if ($deleted && config('web-settings.cache.enabled')) {
            Cache::forget($this->getCacheKey($key->getValue()));
            Cache::forget($this->getCacheKey('all_settings'));
        }

        return $deleted;
    }

    public function all(): Collection
    {
        if (!config('web-settings.cache.enabled')) {
            return $this->repository->all();
        }

        $cacheKey = $this->getCacheKey('all_settings');
        $duration = config('web-settings.cache.duration', 60);

        return Cache::remember($cacheKey, $duration, function () {
            return $this->repository->all();
        });
    }

    public function getByGroup(string $group): Collection
    {
        return $this->repository->getByGroup($group);
    }

    protected function getCacheKey(string $key): string
    {
        return config('web-settings.cache.prefix', 'web_settings_') . $key;
    }
}
