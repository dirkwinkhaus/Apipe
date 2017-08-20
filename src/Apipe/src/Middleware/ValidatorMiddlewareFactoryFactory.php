<?php

namespace Apipe\Middleware;

use Apipe\Validator\ValidatorFactory;
use Interop\Container\ContainerInterface;

/**
 * Class ValidatorMiddlewareFactoryFactory
 * @package Apipe\Middleware
 */
class ValidatorMiddlewareFactoryFactory
{
    /**
     * @param ContainerInterface $container
     * @return ValidatorMiddlewareFactory
     */
    public function __invoke(ContainerInterface $container): ValidatorMiddlewareFactory
    {
        $validatorFactory = $container->get(ValidatorFactory::class);

        return new ValidatorMiddlewareFactory($validatorFactory);
    }
}