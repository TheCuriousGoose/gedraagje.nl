<?php

namespace App\Helpers;

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get or set a setting value.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        if (Setting::where('name', $key)->exists()) {
            $setting = Setting::where('name', $key)->first();

            return $setting->value;
        }

        return false;
    }
}
