<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 13.08.17
 * Time: 16:15
 */

namespace Api\Address\Service;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;

/**
 * Class Authorization
 * @package Address\Service
 */
class Authorization implements MiddlewareInterface
{

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next): ResponseInterface
    {
        if ($next) {
            return $next($request, $response);
        }
    }
}