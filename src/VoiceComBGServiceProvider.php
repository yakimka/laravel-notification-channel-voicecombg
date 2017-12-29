<?php

namespace NotificationChannels\VoiceComBG;

use Illuminate\Support\ServiceProvider;

class VoiceComBGServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(VoiceComBGApi::class, function () {
            $config = config('services.voicecombg');

            return new VoiceComBGApi($config['sid'], $config['url']);
        });
    }
}
