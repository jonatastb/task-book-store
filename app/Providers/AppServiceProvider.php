<?php

namespace App\Providers;

use App\Domain\Store\StoreRepository;
use App\Domain\Book\BookRepository;
use App\Infrastructure\EloquentStoreRepository;
use App\Infrastructure\EloquentBookRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StoreRepository::class, EloquentStoreRepository::class);
        $this->app->bind(BookRepository::class, EloquentBookRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
