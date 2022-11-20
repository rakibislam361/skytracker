<?php

namespace App\Providers;

use App\Domains\Settings\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Support\Facades\Cache $cache
     * @param \App\Domains\Settings\Models\Setting $settings
     * 
     * @return void
     */
    public function boot(Setting $settings)
    {
        // 6 * 60 = 360 minutes
        $settings = Cache::remember('settings', 360, function () use ($settings) {
            return $settings->whereNotNull('active')->pluck('value', 'key')->all();
        });

        config()->set('settings', $settings);
    }
}
