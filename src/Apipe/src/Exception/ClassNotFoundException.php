<?php

namespace Apipe\Exception;

use Exception;

/**
 * Class ClassNotFoundException
 * @package Apipe\Exception
 */
class ClassNotFoundException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * ClassNotFoundException constructor.
     * @param string $className
     */
    public function __construct(string $className)
    {
        parent::__construct(sprintf('Class "%s" not found', $className));
    }
}