<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TinyERP\TinyERPService;
use App\Services\MetricServiceInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MetricServiceInterface::class, TinyERPService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
