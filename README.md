# Slim Framework 3.x FlySystem

[![LICENSE](https://img.shields.io/packagist/l/projek-xyz/slim-flysystem.svg?style=flat-square)](LICENSE.md)
[![VERSION](https://img.shields.io/packagist/v/projek-xyz/slim-flysystem.svg?style=flat-square)](https://github.com/projek-xyz/slim-flysystem/releases)
[![Build Status](https://img.shields.io/travis/projek-xyz/slim-flysystem/master.svg?branch=master&style=flat-square)](https://travis-ci.org/projek-xyz/slim-flysystem)
[![Coveralls](https://img.shields.io/coveralls/projek-xyz/slim-flysystem/master.svg?style=flat-square)](https://coveralls.io/github/projek-xyz/slim-flysystem)
[![Code Climate](https://img.shields.io/codeclimate/github/projek-xyz/slim-flysystem.svg?style=flat-square)](https://codeclimate.com/github/projek-xyz/slim-flysystem)
[![Code Quality](https://img.shields.io/sensiolabs/i/ff54e692-bb1c-4faf-afd0-c681a0e845dd.svg?style=flat-square)](https://insight.sensiolabs.com/projects/ff54e692-bb1c-4faf-afd0-c681a0e845dd)

This is a Slim Framework 3.x component helper that provide FlySystem integration.

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require projek-xyz/slim-flysystem --prefer-dist
```

Requires Slim Framework 3 and PHP 5.5.0 or newer.

## Usage

```php
// Create Slim app
$app = new \Slim\App();

// Fetch DI Container
$container = $app->getContainer();

// Register FlySystem helper:
// Option 1, using FlysystemProvider
$container->register(new \Projek\Slim\FlysystemProvider);

// Option 2, using Closure
$container['fs'] = function ($c) {
    $fs = new \Projek\Slim\Flysystem([
        'local' => [
            'path' => 'path/to/your/resources',
        ]
    ]);

    return $fs;
};

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
    // Read a file.
    $this->fs->read('path/to/file');

    return $response;
});

// Run app
$app->run();
```

**NOTE**: if you are using _option 1_ please make sure you already have `$container['settings']['filesystem']` in your configuration file.

## Custom functions

Description soon.

### `aFunction()`

Description soon.

```php
// ...
```

## Testing

```bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Credits

- [Fery Wardiyanto](http://feryardiant.me)
- [Slim Framework](http://www.slimframework.com)
- [League FlySystem](http://flysystem.thephpleague.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
