<?php

namespace YourVendor\WebSettings\Domain\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use YourVendor\WebSettings\Domain\Models\Setting;

class SettingUpdated
{
    use Dispatchable, SerializesModels;

    public Setting $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
}
