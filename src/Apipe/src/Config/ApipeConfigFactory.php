<?php

namespace Apipe\Config;

use Psr\Container\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ApipeConfigFactory
 * @package Apipe\Config
 *
 * @author Dirk Winkhaus <dirkwinkhaus@googlemail.com>
 */
class ApipeConfigFactory
{
    /**
     * @param ContainerInterface $container
     * @return ApipeConfig
     */
    public function __invoke(ContainerInterface $container): ApipeConfig
    {
        /** @var Filesystem $fileSystem */
        $fileSystem = $container->get(Filesystem::class);
        /** @var ConfigDissolver $configDissolver */
        $configDissolver = $container->get(ConfigDissolver::class);
        /** @var array $config */
        $config = $container->get('config');

        return new ApipeConfig(
            $fileSystem,
            $configDissolver,
            $config['apipe']
        );
    }
}