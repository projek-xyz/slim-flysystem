<?php
/**
 * @link https://kahlan.github.io/docs/config-file.html
 */

use Kahlan\Filter\Filters;
use Kahlan\Reporter\Coverage\Exporter;

/** @var Kahlan\Cli\Kahlan $this */
$cli = $this->commandLine();
$cli->option('coverage', 'default', 3);
$cli->option('spec', 'default', ['tests/spec']);
$cli->option('lcov', 'default', 'tests/lcov.info');

Filters::apply($this, 'reporting', function ($next) {
    if (! $reporter = $this->reporters()->get('coverage')) {
        return;
    }

    $lcov_file = getenv('LCOV_REPORT') ?: $this->reporters()->get('lcov');

    if ($lcov_file) {
        Exporter\Lcov::write([
            'collector' => $reporter,
            'file'      => $lcov_file,
        ]);
    }

    return $next();
});
