<?php


namespace Apipe\Exception;

use Exception;

/**
 * Class ValidatorNotFoundException
 * @package Apipe\Exception
 */
class ValidatorNotFoundException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * ValidatorNotFoundException constructor.
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        parent::__construct(sprintf('Validator "%s" not found.', $identifier), 500);
    }
}