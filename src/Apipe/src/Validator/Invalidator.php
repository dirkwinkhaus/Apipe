<?php


namespace Apipe\Validator;

use Zend\Validator\ValidatorInterface;

/**
 * Class Invalidator
 * @package Apipe\Validator
 */
class Invalidator implements ValidatorInterface
{

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool
    {
        return false;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return ['errorMessage' => 'someError'];
    }
}