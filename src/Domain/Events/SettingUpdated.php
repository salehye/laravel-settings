<?php

namespace Salehye\LaravelSettings\Domain\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Salehye\LaravelSettings\Domain\Models\Setting;

class SettingUpdated
{
    use Dispatchable, SerializesModels;

    public Setting $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
}
