<?php
namespace Projek\Slim;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use InvalidArgumentException;

class FlysystemProvider implements ServiceProviderInterface
{
    /**
     * Register this plates view provider with a Pimple container
     *
     * @param \Pimple\Container $container
     */
    public function register(Container $container)
    {
        $settings = $container->get('settings');

        if (!isset($settings['fs'])) {
            throw new InvalidArgumentException('Filesystem configuration not found');
        }

        $container['fs'] = new Flysystem($settings['fs']);
    }
}
