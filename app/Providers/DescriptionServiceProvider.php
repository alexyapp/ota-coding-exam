<?php

namespace App\Providers;

use App\Repositories\Description\DescriptionRepository;
use App\Repositories\Description\DescriptionRepositoryInterface;
use App\Services\Description\DescriptionService;
use App\Services\Description\DescriptionServiceInterface;
use Illuminate\Support\ServiceProvider;

class DescriptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DescriptionRepositoryInterface::class, DescriptionRepository::class);
        $this->app->bind(DescriptionServiceInterface::class, DescriptionService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
