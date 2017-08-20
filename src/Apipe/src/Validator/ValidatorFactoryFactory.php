<?php


namespace Apipe\Validator;

use Interop\Container\ContainerInterface;

/**
 * Class ValidatorFactoryFactory
 * @package Apipe\Validator
 */
class ValidatorFactoryFactory
{
    /**
     * @param ContainerInterface $container
     * @return ValidatorFactory
     */
    public function __invoke(ContainerInterface $container): ValidatorFactory
    {
        return new ValidatorFactory($container);
    }
}