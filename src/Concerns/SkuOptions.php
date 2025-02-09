<?php

declare(strict_types=1);

namespace pointybeard\LaravelSku\Concerns;

use Spatie\LaravelData\Data;

class SkuOptions extends Data
{
    public function __construct(
        public string $pattern,
        public string $target,
        public bool $unique = true
    ) {}
}
