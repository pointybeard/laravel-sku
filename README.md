# Laravel SKU

A Laravel package for generating SKU codes from regular expressions.

## Installation

This library is installed via [Composer](http://getcomposer.org/). To install, use `composer require pointybeard/laravel-sku`.

### Requirements

This library requires PHP 8.2 or greater.

## Usage

### Adding SKUs to Models

Use the `HasSku` trait in your Eloquent model to automatically generate SKUs. You can customize options like the regex pattern, uniqueness enforcement, and the database column for storing SKUs directly in your model properties.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use pointybeard\LaravelSku\Traits\HasSku;

class Product extends Model
{
    use HasSku;

    protected $fillable = ['title', 'sku'];

    protected $skuPattern = '[A-Z]{3}-[0-9]{4}'; // Custom regex pattern

    protected $skuUnique = true; // Enforce unique SKUs

    protected $skuColumn = 'sku'; // Column to store the SKU
}

$product = Product::create([
    'title' => 'Board Game',
]);

echo $product->sku;
// e.g. AUSJ-9276
```

### Configuration

The default configuration can be found in `config/laravel-sku.php`. You can override it by publishing the configuration file.

### Supported Regular Expression Syntax

The supported regular expression syntax for SKU generation is documented on the [ReverseRegex GitHub page](https://github.com/pointybeard-forks/reverse-regex). 

This package relies on the ReverseRegex library for regex-based string generation, so please refer to that documentation for details on the syntax and capabilities.

### Advanced Usage

You can use the `SkuService` directly to generate SKUs for non-model contexts or other custom workflows. Pass configuration options and an optional uniqueness checker to the service.

```php
<?php

use pointybeard\LaravelSku\Facades\Sku;

echo Sku::generate('[A-Z]{3}-\d');
// e.g. "FKS-8"

echo Sku::generate(
    pattern: 'ABC-[A-Z]{4}-[0-9]{4}',
    validator: fn ($sku): bool => !in_array($sku, ['ABC-GAMI-1234', 'ABC-LAPT-5678'])
);

// e.g. "ABC-UJSO-2837"
```

## Support

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/pointybeard/laravel-sku/issues),
or better yet, fork the library and submit a pull request.

## Contributing

We encourage you to contribute to this project. Please check out the [Contributing documentation](https://github.com/pointybeard/laravel-sku/blob/master/CONTRIBUTING.md) for guidelines about how to get involved.

## Acknowledgments

This package draws inspiration from the [`binary-cats/laravel-sku`](https://github.com/binary-cats/laravel-sku) package. We appreciate their foundational work, which served as a reference for some of the concepts implemented here.

## License

"Laravel SKU" is released under the [MIT License](http://www.opensource.org/licenses/MIT).
