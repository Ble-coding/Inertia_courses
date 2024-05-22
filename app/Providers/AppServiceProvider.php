<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Youtube\YoutubeServices;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        $this->app->singleton('App\Youtube\YoutubeServices', function () {
            return new YoutubeServices(env('YOUTUBE_API_KEY'));
        });
    }
}
