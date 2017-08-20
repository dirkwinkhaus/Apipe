<?php

namespace Apipe\Middleware;

use Apipe\Model\ParameterModel;
use Apipe\Validator\ValidatorFactory;
use Interop\Container\ContainerInterface;

/**
 * Class ValidatorMiddlewareFactory
 * @package Apipe\Validator
 */
class ValidatorMiddlewareFactory
{

    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    /**
     * ValidatorMiddlewareFactory constructor.
     * @param ValidatorFactory $validatorFactory
     */
    public function __construct(ValidatorFactory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    /**
     * @param ParameterModel $parameterModel
     * @return ValidatorMiddleware
     */
    public function create(ParameterModel $parameterModel): ValidatorMiddleware
    {
        return new ValidatorMiddleware($this->validatorFactory, $parameterModel);
    }
}