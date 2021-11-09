<?php

namespace App\Providers;

use App\Repositories\Contracts\PocketRepositoryInterface;
use App\Repositories\Eloquent\PocketRepository;
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
        $this->app->bind(PocketRepositoryInterface::class, PocketRepository::class);
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
