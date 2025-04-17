<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AttendeeRepositoryInterface;
use App\Repositories\AttendeeRepository;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\BookingRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(abstract: AttendeeRepositoryInterface::class, concrete:AttendeeRepository::class);
        $this->app->bind(abstract: EventRepositoryInterface::class, concrete:EventRepository::class);
        $this->app->bind(abstract: BookingRepositoryInterface::class, concrete:BookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
