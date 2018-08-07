# Attributes schema for Eloquent

[![Build Status](https://travis-ci.org/n7olkachev/laravel-attributes-schema.svg?branch=master)](https://travis-ci.org/n7olkachev/laravel-attributes-schema)

## Installation

You can install the package via composer:

``` bash
composer require n7olkachev/laravel-attributes-schema
```

Next, add AttributesSchema trait to your models:

```php
use AttributesSchema;
```

Then, implement `public function attributesSchema` as in examples.

## Examples

```php
class Product extends Model
{
    use AttributesSchema;

    public function attributesSchema()
    {
        return [
            'name' => Attribute::fillable()->default('Dummy title'),
            'description' => Attribute::fillable()->rules('min:10|max:255'),
            'guarded' => Attribute::guarded(),
        ];
    }
}
```

## Testing

``` bash
$ composer test
```

## Credits

- [Nikita Tolkachev](https://github.com/n7olkachev)

## Sponsored by

https://websecret.by/

Web agency based in Minsk, Belarus

## License

The MIT License (MIT)
