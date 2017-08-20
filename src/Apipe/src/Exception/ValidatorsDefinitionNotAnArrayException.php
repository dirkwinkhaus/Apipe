<?php


namespace Apipe\Exception;

use Exception;

/**
 * Class ValidatorsDefinitionNotAnArrayException
 * @package Apipe\Exception
 */
class ValidatorsDefinitionNotAnArrayException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * ValidatorsDefinitionNotAnArrayException constructor.
     */
    public function __construct()
    {
        parent::__construct("Validators definition not an array. Expected ['parameterKey' => [validator1, validator2...]]", 500);
    }
}