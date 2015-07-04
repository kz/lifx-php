# lifx-php

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-coveralls]][link-coveralls]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

lifx-php is a PHP package for the LIFX HTTP API. 

The author is not affiliated with LIFX and LIFX is not involved in the development of this package in any way.

## Install

Via Composer

``` bash
$ composer require kz/lifx-php
```

## Laravel Configuration

lifx-php has optional support for Laravel and comes with a Service Provider and Facades for easy integration. The vendor/autoload.php is included by Laravel, so you don't have to require or autoload manually. Just see the instructions below.

After you have installed lifx-php, open your Laravel config file config/app.php and add the following lines.

In the $providers array add the service providers for this package:

``` php
Kz\Lifx\LifxServiceProvider::class,
```

Add the facade of this package to the $aliases array:

``` php
'Lifx' => Kz\Lifx\LifxFacade::class,
```

Now the Lifx Class will be auto-loaded by Laravel.

You also need to supply your API Token in your .env environment file:

```
LIFX_TOKEN=0000000000000000000000000000000000000000000000000000000000000000
```

## Usage

``` php
$api_token = 'token';
$lifx = new Kz\Lifx($api_token);
$lifx->toggleLights();
```

## Laravel Usage

``` php
// usage inside a laravel route
Route::get('/', function()
{
    $lifx = Lifx::all();

    return json_decode($lifx);
});
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Kelvin Zhang](https://github.com/kz)
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/kz/lifx-php.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/kz/lifx-php/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/kz/lifx-php.svg?style=flat-square
[ico-coveralls]: https://img.shields.io/coveralls/kz/lifx-php/lifx-php.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/kz/lifx-php.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/kz/lifx-php.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/kz/lifx-php
[link-travis]: https://travis-ci.org/kz/lifx-php
[link-coveralls]: https://coveralls.io/r/kz/lifx-php
[link-code-quality]: https://scrutinizer-ci.com/g/kz/lifx-php
[link-downloads]: https://packagist.org/packages/kz/lifx-php
[link-author]: https://github.com/kz
[link-contributors]: ../../contributors
