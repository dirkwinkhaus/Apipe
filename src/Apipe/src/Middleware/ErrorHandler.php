<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 13.08.17
 * Time: 20:28
 */

namespace Apipe\Middleware;

use ErrorException;
use Exception;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\TextResponse;

/**
 * Class ErrorHandler
 * @package Api\ErrorHandler
 */
class ErrorHandler implements MiddlewareInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * ErrorHandler constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        set_error_handler([$this, 'silentErrorHandler']);

        try {
            $response = $delegate->process($request);
            return $response;
        } catch (\Throwable $exception) {
        } catch (Exception $exception) {
        }

        restore_error_handler();

        $errorCode = $exception->getCode();
        if (!$errorCode > 0) {
            $errorCode = 500;
        }

        $returnValue = $this->buildReturnArray(
            $errorCode,
            $exception,
            $this->config['showTrace'] ?? false
        );

        return new JsonResponse(
            $returnValue,
            $errorCode
        );
    }

    /**
     * @param $errorNumber
     * @param $errorMessage
     * @param $errorFile
     * @param $errorLine
     * @throws ErrorException
     */
    public function silentErrorHandler(
        int $errorNumber,
        string $errorMessage,
        string $errorFile,
        int $errorLine
    ): void {
        if (!(error_reporting() & $errorNumber)) {
            return;
        }

        throw new ErrorException($errorMessage, 0, $errorNumber, $errorFile, $errorLine);
    }

    /**
     * @param $errorCode
     * @param $exception
     * @param $showTrace
     * @return array
     */
    private function buildReturnArray(
        int $errorCode,
        Exception $exception,
        bool $showTrace
    ): array {
        $returnValue = [
            'code' => $errorCode,
            'message' => $exception->getMessage(),
        ];

        if ($showTrace) {
            $returnValue['trace'] = $exception->getTrace();
        }
        return $returnValue;
    }
}