<?php

namespace Apipe\Exception;

use Exception;

/**
 * Class ResourceNotFoundException
 * @package Apipe\Exception
 */
class ResourceNotFoundException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * ResourceNotFoundException constructor.
     * @param string $resource
     * @param Exception|null $previous
     */
    public function __construct(string $resource = "", ?Exception $previous = null)
    {
        parent::__construct(sprintf('Resource not found: %s', $resource), 404, $previous);
    }
}