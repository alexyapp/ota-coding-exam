<?php

namespace App\Providers;

use App\Repositories\JobAd\JobAdRepository;
use App\Repositories\JobAd\JobAdRepositoryInterface;
use App\Services\JobAd\JobAdService;
use App\Services\JobAd\JobAdServiceInterface;
use Illuminate\Support\ServiceProvider;

class JobAdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(JobAdRepositoryInterface::class, JobAdRepository::class);
        $this->app->bind(JobAdServiceInterface::class, JobAdService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
