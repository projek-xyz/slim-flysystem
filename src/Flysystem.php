<?php
namespace Projek\Slim;

use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use League\Flysystem\Adapter;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use LogicException;

/**
 * @mixin \League\Flysystem\FilesystemInterface
 */
class Flysystem
{
    /**
     * @var array<string, array>
     */
    protected $settings = [
        'local' => [
            'path' => null,
        ],
    ];

    /**
     * @var null|\League\Flysystem\Filesystem
     */
    protected $fs = null;

    /**
     * @var \League\Flysystem\MountManager
     */
    protected $mounts;

    /**
     * Create new Projek\Slim\Flysystem instance
     *
     * @param string[] $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);

        $mounts = [];

        if (!is_null($this->settings['local']['path'])) {
            $mounts['local'] = new Filesystem(new Adapter\Local($this->settings['local']['path']));
        }

        $this->mounts = new MountManager($mounts);
    }

    /**
     * Magic method to connect to filesystem for convenience
     *
     * @param  string $prefix Filesystem name
     * @return $this
     */
    public function __get($prefix)
    {
        $this->fs = $this->mounts->getFilesystem($prefix);

        return $this;
    }

    public function __call($method, $args)
    {
        /**
         * @var \League\Flysystem\FilesystemInterface
         */
        $filesystem = $this->fs ?: $this->mounts;

        return call_user_func_array([$filesystem, $method], $args);
    }

    /**
     * Get the Flysystem instance with Local adapter
     *
     * @return \League\Flysystem\Filesystem
     */
    public function getFlysystem()
    {
        return $this->mounts->getFilesystem('local');
    }

    /**
     * Mound local adapter with given $path
     *
     * @param  string $path
     * @return $this
     */
    public function mountLocal($path)
    {
        if (isset($this->settings[$path]['path'])) {
            $this->fs = $this->mounts->getFilesystem($path);

            return $this;
        }

        $this->fs = new Filesystem(new Adapter\Local($path));

        return $this;
    }

    /**
     * Mount FTP
     *
     * @param  string   $host
     * @param  string   $username
     * @param  string   $password
     * @param  string[] $opt
     * @return $this
     */
    public function mountFtp($host, $username = '', $password = '', array $opt = [])
    {
        if (isset($this->settings[$host]['host'])) {
            $this->fs = $this->mounts->getFilesystem($host);

            return $this;
        }

        $opts = array_merge($opt, [
            'host' => $host,
            'username' => $username,
            'password' => $password,
        ]);

        $this->fs = new Filesystem(new Adapter\Ftp($opts));

        return $this;
    }

    /**
     * Mount Archive
     *
     * @param  string $path
     * @throws \LogicException
     * @return $this
     */
    public function mountArchive($path)
    {
        if (!class_exists(ZipArchiveAdapter::class)) {
            throw new LogicException('No adapter found to mount Zip Archive.');
        }

        $this->fs = new Filesystem(new ZipArchiveAdapter($path));

        return $this;
    }
}
