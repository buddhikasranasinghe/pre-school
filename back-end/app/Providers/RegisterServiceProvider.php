<?php

namespace App\Providers;

use Domain\Registration\Action\Interface\Application;
use Domain\Registration\Action\Repository\Application as RepositoryApplication;
use Illuminate\Support\ServiceProvider;

class RegisterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Application::class, RepositoryApplication::class);
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
