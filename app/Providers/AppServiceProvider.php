<?php

namespace App\Providers;

use App\Services\ContentService;
use App\Services\Contracts\ContentServiceInterface;
use App\Services\Contracts\PocketServiceInterface;
use App\Services\PocketService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PocketServiceInterface::class, PocketService::class);
        $this->app->bind(ContentServiceInterface::class, ContentService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
