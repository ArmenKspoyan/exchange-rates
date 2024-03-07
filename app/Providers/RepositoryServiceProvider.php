<?php

declare(strict_types=1);

namespace App\Providers;


use App\Repositories\Contracts\Currency\ICurrencyRepository;
use App\Repositories\Currency\CurrencyRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ICurrencyRepository::class, CurrencyRepository::class);

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
