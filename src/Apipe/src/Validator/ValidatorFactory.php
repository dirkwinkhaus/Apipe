<?php


namespace Apipe\Validator;

use Apipe\Exception\ObjectNotInstanceOfValidatorInterfaceException;
use Apipe\Exception\ValidatorNotFoundException;
use Interop\Container\ContainerInterface;
use Zend\Validator\ValidatorInterface;

/**
 * Class ValidatorFactory
 * @package Apipe\Validator
 */
class ValidatorFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ValidatorFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $identifier
     * @return ValidatorInterface
     * @throws ObjectNotInstanceOfValidatorInterfaceException
     * @throws ValidatorNotFoundException
     */
    public function create(string $identifier): ValidatorInterface
    {
        if (!$this->container->has($identifier)) {
            throw new ValidatorNotFoundException($identifier);
        }

        $validator = $this->container->get($identifier);

        if (!$validator instanceof ValidatorInterface) {
            throw new ObjectNotInstanceOfValidatorInterfaceException($identifier);
        }

        return $validator;
    }
}