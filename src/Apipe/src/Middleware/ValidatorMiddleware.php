<?php


namespace Apipe\Middleware;

use Apipe\Exception\ParameterValidationFailedException;
use Apipe\Exception\ValidatorsDefinitionNotAnArrayException;
use Apipe\Model\ParameterModel;
use Apipe\Validator\ValidatorFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Stratigility\MiddlewareInterface;
use Zend\Validator\ValidatorInterface;


/**
 * Class Validator
 * @package Apipe\Validator
 */
class ValidatorMiddleware implements MiddlewareInterface
{
    /**
     * @var array
     */
    private $messages = [];

    /**
     * @var ParameterModel
     */
    private $parameterModel;

    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    /**
     * ValidatorMiddleware constructor.
     * @param ParameterModel $parameterModel
     * @param ValidatorFactory $validatorFactory
     */
    public function __construct(
        ValidatorFactory $validatorFactory,
        ParameterModel $parameterModel
    ) {
        $this->parameterModel = $parameterModel;
        $this->validatorFactory = $validatorFactory;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return mixed
     * @throws ParameterValidationFailedException
     */
    public function __invoke(Request $request, Response $response, callable $next): ResponseInterface
    {
        $isValid = $this->parameterValidator(
            array_merge(
                $this->parameterModel->getRequired(),
                $this->parameterModel->getOptional()
            ),
            $request
        );

        if (!$isValid) {
            throw new ParameterValidationFailedException($this->messages);
        }

        return $next($request, $response);
    }

    /**
     * @param array $parameterData
     * @param Request $request
     * @return bool
     * @throws ValidatorsDefinitionNotAnArrayException
     */
    private function parameterValidator(array $parameterData, Request $request): bool
    {
        foreach ($parameterData as $parameterName => $validatorArray) {
            if (!is_array($validatorArray)) {
                throw new ValidatorsDefinitionNotAnArrayException();
            }

            $isValid = true;
            $this->messages = [];

            foreach ($validatorArray as $validatorName) {

                /** @var ValidatorInterface $validatorInstance */
                $validatorInstance = $this->validatorFactory->create($validatorName);

                if ($validatorInstance->isValid($request->getAttribute($parameterName)) === false) {
                    $isValid = false;
                    $this->messages = array_merge($this->messages, $validatorInstance->getMessages());
                }
            }

            return $isValid;
        }
    }
}