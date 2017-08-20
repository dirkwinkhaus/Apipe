<?php


namespace Apipe\Exception;

use Apipe\Config\ConfigProviderInterface;
use Exception;

/**
 * Class ObjectNotInstanceOfConfigProviderException
 * @package Apipe\Exception
 */
class ObjectNotInstanceOfConfigProviderException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * ObjectNotInstanceOfValidatorInterfaceException constructor.
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        parent::__construct(sprintf('Object "%s" not instance of %s.', $identifier, ConfigProviderInterface::class), 500);
    }
}