<?php


namespace Apipe\Config;

use Apipe\Exception\ClassNotFoundException;
use Apipe\Exception\ObjectNotInstanceOfConfigProviderException;

/**
 * Class ConfigDissolver
 * @package Apipe\Config
 */
class ConfigDissolver
{
    /**
     * @param array $config
     * @return array
     */
    public function dissolve(array $config): array
    {
        foreach ($config as $configKey => $configValue) {
            if (is_string($configValue)) {
                unset($config[$configKey]);

                $configProvider = $this->createConfigProvider($configValue);
                $config[$configValue] = $configProvider->getConfig();
            }
        }

        return $config;
    }

    /**
     * @param string $className
     * @return ConfigProviderInterface
     * @throws ClassNotFoundException
     * @throws ObjectNotInstanceOfConfigProviderException
     */
    private function createConfigProvider(string $className): ConfigProviderInterface
    {
        if (!class_exists($className)) {
            throw new ClassNotFoundException($className);
        }

        $configProvider = new $className();

        if (!$configProvider instanceof ConfigProviderInterface) {
            throw new ObjectNotInstanceOfConfigProviderException($className);
        }

        return $configProvider;
    }
}