<?php
namespace Projek\Slim\Tests;

use Projek\Slim\Flysystem;
use PHPUnit_Framework_TestCase;

abstract class TestCase extends PHPUnit_Framework_TestCase
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
