[![Version](https://img.shields.io/packagist/v/projek-xyz/slim-flysystem?style=flat-square)](https://packagist.org/packages/projek-xyz/slim-flysystem)
[![Lisence](https://img.shields.io/github/license/projek-xyz/slim-flysystem?style=flat-square)](https://github.com/projek-xyz/slim-flysystem/blob/main/LICENSE)
[![Actions Status](https://img.shields.io/github/actions/workflow/status/projek-xyz/slim-flysystem/test.yml?branch=main&style=flat-square)](https://github.com/projek-xyz/slim-flysystem/actions)
[![Coveralls](https://img.shields.io/coveralls/projek-xyz/slim-flysystem/master.svg?style=flat-square&logo=coveralls)](https://coveralls.io/github/projek-xyz/slim-flysystem)
[![Code Climate](https://img.shields.io/codeclimate/coverage/projek-xyz/slim-flysystem.svg?style=flat-square&logo=code-climate)](https://codeclimate.com/github/projek-xyz/slim-flysystem/coverage)
[![Maintainability](https://img.shields.io/codeclimate/maintainability/projek-xyz/slim-flysystem?style=flat-square&logo=code-climate)](https://codeclimate.com/github/projek-xyz/slim-flysystem/maintainability)
[![SymfonyInsight Grade](https://img.shields.io/symfony/i/grade/847662a6-71b8-4e7b-ae16-d7f98b7eae80?style=flat-square&logo=symfony)](https://insight.symfony.com/projects/847662a6-71b8-4e7b-ae16-d7f98b7eae80)

# FlySystem Integration for Slim micro framework 3

Access your Slim 3 application file system using FlySystem.

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require projek-xyz/slim-flysystem --prefer-dist
```

Requires Slim micro framework 3 and PHP 5.5.0 or newer.

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

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](.github/CONDUCT.md) for details.

## License

This library is open-sourced software licensed under [MIT license](LICENSE.md).
