<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\parentRepository;
use App\RepositoriesInterfaces\parentRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(parentRepositoryInterface::class, parentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
