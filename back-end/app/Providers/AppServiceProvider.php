<?php

namespace App\Providers;

use App\Commands\Interfaces\AuthTokenRepositoryInterface;
use App\Commands\Interfaces\LoginRepositoryInterface;
use App\Commands\Repositories\AuthTokenRepository;
use App\Commands\Repositories\LoginRepository;
use Domain\Registration\Action\Command\Interface\ApplicationInterface;
use Domain\Registration\Action\Command\Repository\ApplicationRepository;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(AuthTokenRepositoryInterface::class, AuthTokenRepository::class);
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(ApplicationInterface::class, ApplicationRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
