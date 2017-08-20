<?php

namespace Apipe\Exception;

use Exception;
use Zend\Validator\ValidatorInterface;

/**
 * Class ObjectNotInstanceOfValidatorInterfaceException
 * @package Apipe\Exception
 */
class ObjectNotInstanceOfValidatorInterfaceException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * ObjectNotInstanceOfValidatorInterfaceException constructor.
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        parent::__construct(sprintf('Object "%s" not instance of %s.', $identifier, ValidatorInterface::class), 500);
    }
}