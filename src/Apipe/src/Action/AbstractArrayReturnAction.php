<?php

namespace Apipe\Action;

use Apipe\Exception\ResourceNotFoundException;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class AbstractArrayReturnAction
 * @package Api\Address\ZipCode\Get
 */
abstract class AbstractArrayReturnAction implements MiddlewareInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * AbstractArrayReturnAction constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return JsonResponse
     * @throws ResourceNotFoundException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $id = $request->getAttribute('id', '');

        if ($id === null) {
            $dispatchData = $this->data;
        } else {
            $resourceId = $id - 1;
            $dispatchData = $this->data[$resourceId] ?? null;
        }

        if ($dispatchData === null) {
            throw new ResourceNotFoundException((string) $id);
        }

        $response = new JsonResponse(
            $dispatchData
        );

        $delegate->process($request);

        return $response;
    }

}
