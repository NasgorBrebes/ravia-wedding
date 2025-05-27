<?php
namespace App\Services;

use App\Models\WeddingSetting;
use Illuminate\Support\Facades\Cache;

class WeddingSettingService
{
    public function getAllSettings()
    {
        return Cache::remember('wedding_settings', 3600, function () {
            return WeddingSetting::all()->pluck('value', 'key')->toArray();
        });
    }

    public function getSetting($key, $default = null)
    {
        $settings = $this->getAllSettings();
        return $settings[$key] ?? $default;
    }

    public function setSetting($key, $value, $type = 'text')
    {
        WeddingSetting::setSetting($key, $value, $type);
        Cache::forget('wedding_settings');
        return true;
    }

    public function setMultipleSettings($settings)
    {
        foreach ($settings as $key => $value) {
            WeddingSetting::setSetting($key, $value);
        }
        Cache::forget('wedding_settings');
        return true;
    }
}
