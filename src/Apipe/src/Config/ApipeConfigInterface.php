<?php


namespace Apipe\Config;

/**
 * Interface ApipeConfigInterface
 * @package Apipe\Config
 *
 * @author Dirk Winkhaus <dirkwinkhaus@googlemail.com>
 */
interface ApipeConfigInterface
{
    /**
     * @return array
     */
    public function getConfig(): array;
}