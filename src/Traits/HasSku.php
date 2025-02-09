<?php

declare(strict_types=1);

namespace pointybeard\LaravelSku\Traits;

use pointybeard\LaravelSku\Concerns\SkuOptions;
use pointybeard\LaravelSku\Facades\Sku;

trait HasSku
{
    public static function bootHasSku()
    {
        static::creating(function ($model) {

            $options = $model->getSkuOptions();

            if (! $model->{$options->column}) {
                $model->{$options->column} = Sku::generate(
                    pattern: $options->pattern,
                    validator: fn (string $sku): bool => $options->unique
                        ? ! $model->where($options->column, $sku)->exists()
                        : true
                );
            }
        });
    }

    public function getSkuOptions(): SkuOptions
    {
        $options = config('laravel-sku.defaults');

        return SkuOptions::from([
            'pattern' => $this->skuPattern ?? $options['pattern'],
            'column' => $this->skuColumn ?? $options['column'],
            'unique' => $this->skuUnique ?? $options['unique'],
        ]);
    }
}
