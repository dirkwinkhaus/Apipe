<?php
#
namespace Apipe\Exception;

use Exception;

/**
 * Class ParameterValidationFailedExecption
 * @package Apipe\Exception
 */
class ParameterValidationFailedException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * ParameterValidationFailedExecption constructor.
     * @param array $messages
     */
    public function __construct(array $messages)
    {
        parent::__construct(json_encode($messages), 500);
    }
}