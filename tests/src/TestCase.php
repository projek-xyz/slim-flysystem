<?php
namespace Projek\Slim\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Projek\Slim\Flysystem;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var \Projek\Slim\FlySystem
     */
    protected $fs;

    /**
     * Slim Application settings
     *
     * @var array
     */
    protected $settings = [
        'local' => [
            'path' => null,
        ],
    ];

    public function setUp()
    {
        $this->settings['local']['path'] = dirname(__DIR__).'/asset';
        $this->fs = new Flysystem($this->settings);
    }
}
