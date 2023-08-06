<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tests\Feature\LoginTest;

class ClassServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoginTest::class, function (string $email, string $password) {
            return new LoginTest($email, $password);
        });
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
