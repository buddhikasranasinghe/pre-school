<?php

namespace App\Providers;

use App\Commands\Interfaces\LoginRepositoryInterface;
use App\Commands\Repositories\LoginRepository;
use Illuminate\Support\ServiceProvider;

class LoginRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
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
