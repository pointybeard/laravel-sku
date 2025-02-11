<?php

declare(strict_types=1);

return [
    'defaults' => [
        'pattern' => 'SKU-[0-9]{5}-[A-Z]{1}',

        'target' => 'sku',

        'unique' => true,
    ],
];
