<?php
namespace Projek\Slim\Tests;

use Slim\App;
use Projek\Slim\FlysystemProvider;
use League\Flysystem\FilesystemInterface;

class FlysystemProviderTest extends TestCase
{
    public function testAddContainer()
    {
        $settings = ['fs' => $this->settings];
        $app = new App(['settings' => $settings]);
        $container = $app->getContainer();
        $container->register(new FlysystemProvider);

        $this->assertTrue($container->has('fs'));
        $this->assertInstanceOf(FilesystemInterface::class, $container->get('fs')->getFlysystem());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLoggerSettings()
    {
        $app = new App(['settings' => $this->settings]);
        $container = $app->getContainer();
        $container->register(new FlysystemProvider);
    }
}
