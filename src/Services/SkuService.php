<?php

declare(strict_types=1);

namespace pointybeard\LaravelSku\Services;

use pointybeard\LaravelSku\Exceptions\MaxAttemptsExceededException;
use ReverseRegex\Generator\Scope;
use ReverseRegex\Lexer;
use ReverseRegex\Parser;
use ReverseRegex\Random\SimpleRandom;

class SkuService
{
    public function generate(string $pattern, ?callable $validator = null, int $attempts = 10): string
    {
        $current_attempt = 0;

        do {
            // (guard) maximum number of attempts has been reached
            if ($current_attempt >= $attempts) {
                throw new MaxAttemptsExceededException("Failed to generate a unique SKU after {$attempts} attempts.");
            }

            $result = '';

            $sku = (new Parser(new Lexer($pattern), new Scope, new Scope))
                ->parse()
                ->getResult()
                ->generate($result, new SimpleRandom);

            $current_attempt++;
        } while ($validator && ! $validator($sku));

        return $sku;
    }
}
