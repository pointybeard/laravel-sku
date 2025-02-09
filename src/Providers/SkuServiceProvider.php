<?php

declare(strict_types=1);

namespace pointybeard\LaravelSku\Providers;

use Illuminate\Support\ServiceProvider;
use pointybeard\LaravelSku\Services\SkuService;

class SkuServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/laravel-sku.php' => config_path('laravel-sku.php'),
            ], 'config');
        }

        \Illuminate\Foundation\AliasLoader::getInstance()
            ->alias('Sku', \pointybeard\LaravelSku\Facades\Sku::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/laravel-sku.php', 'laravel-sku');

        $this->app->singleton(SkuService::class, function ($app) {
            return new SkuService;
        });
    }
}
