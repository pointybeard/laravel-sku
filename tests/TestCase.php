<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \pointybeard\LaravelSku\Providers\SkuServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Set up database or configuration if needed
        $app['config']->set('sku.default', [
            'source' => 'name',
            'regex' => '[A-Z]{3}-[A-Z]{3}-[0-9A-Z]{6}',
            'unique' => true,
            'column' => 'sku',
        ]);
    }
}
