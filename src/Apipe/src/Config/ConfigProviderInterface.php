<?php


namespace Apipe\Config;

/**
 * Interface ConfigProviderInterface
 * @package Apipe\Routing
 */
interface ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getConfig(): array;
}