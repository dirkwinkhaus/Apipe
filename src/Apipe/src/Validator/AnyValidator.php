<?php


namespace Apipe\Validator;

use Zend\Validator\ValidatorInterface;

/**
 * Class AnyValidator
 * @package Apipe\Validator
 */
class AnyValidator implements ValidatorInterface
{

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return [];
    }
}