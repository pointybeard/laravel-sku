<?php

declare(strict_types=1);

namespace pointybeard\LaravelSku\Facades;

use Illuminate\Support\Facades\Facade;

class Sku extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \pointybeard\LaravelSku\Services\SkuService::class;
    }
}
