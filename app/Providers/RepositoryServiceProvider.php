<?php

namespace App\Providers;

use App\Repositories\Contracts\ContentRepositoryInterface;
use App\Repositories\Contracts\EloquentRepositoryInterface;
use App\Repositories\Contracts\PocketRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\ContentRepository;
use App\Repositories\Eloquent\PocketRepository;
use App\Repositories\Eloquent\TagRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(PocketRepositoryInterface::class, PocketRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
