<?php

namespace App\Providers;

use App\Repository\KostImplement;
use App\Repository\Repository;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(Repository::class, KostImplement::class);
        // $this->app->bind(KostService::class, KostServiceImpl::class);
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
