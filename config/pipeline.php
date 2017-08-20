<?php

use Apipe\Routing\PipelineBuilder;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Middleware\ImplicitOptionsMiddleware;

/** @var \Zend\Expressive\Application $app */
$config = $container->get('config');

$app->pipe($config['apipe']['errorHandler']);
$app->pipe(ServerUrlMiddleware::class);
$app->pipe(PipelineBuilder::class);

$app->pipeRoutingMiddleware();

$app->pipe(ImplicitHeadMiddleware::class);
$app->pipe(ImplicitOptionsMiddleware::class);
$app->pipe(UrlHelperMiddleware::class);

$app->pipeDispatchMiddleware();

$app->pipe($config['apipe']['notFoundHandler']);
