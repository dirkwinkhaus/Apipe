<?php

namespace Apipe\Config;

use Psr\Container\ContainerInterface;

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
        /** @var array $config */
        $config = $container->get('config');
        /** @var ConfigDissolver $configDissolver */
        $configDissolver = $container->get(ConfigDissolver::class);

        return new ApipeConfig($config['apipe'], $configDissolver);
    }
}