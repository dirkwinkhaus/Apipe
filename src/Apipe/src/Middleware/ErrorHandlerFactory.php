<?php

namespace Apipe\Middleware;


use Apipe\Config\ApipeConfigInterface;
use Interop\Container\ContainerInterface;

/**
 * Class ErrorHandlerFactory
 * @package Apipe\Middleware
 */
class ErrorHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return ErrorHandler
     */
    public function __invoke(ContainerInterface $container): ErrorHandler
    {
        /** @var ApipeConfigInterface $config */
        $config = $container->get(ApipeConfigInterface::class);

        return new ErrorHandler($config->getConfig()['settings']['errorHandler'] ?? []);
    }
}