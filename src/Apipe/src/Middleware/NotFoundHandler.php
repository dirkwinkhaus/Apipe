<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 13.08.17
 * Time: 20:51
 */

namespace Apipe\Middleware;

use Apipe\Exception\ResourceNotFoundException;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class NotFoundHandler
 * @package Api\ErrorHandler
 */
class NotFoundHandler implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface
     */
    public function process(
        ServerRequestInterface $request,
        DelegateInterface $delegate
    ): ResponseInterface {
        return new JsonResponse(
            [
                'messsage' => 'Page not found: ' . $request->getUri(),
                'code' => 404
            ],
            404
        );
    }
}