<?php


namespace Apipe\Routing;

use Apipe\Middleware\ValidatorMiddlewareFactory;
use Apipe\Model\ApiModel;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\ServiceManager\Config;

/**
 * Class RoutingCreator
 * @package Aipe\Routing
 *
 * @author Dirk Winkhaus <dirkwinkhaus@googlemail.com>
 */
class PipelineBuilderFactory
{
    /**
     * @param ContainerInterface $container
     * @return PipelineBuilder
     */
    public function __invoke(ContainerInterface $container): PipelineBuilder
    {
        /** @var Application $application */
        $application = $container->get(Application::class);
        /** @var Config $config */
        $apiModel = $container->get(ApiModel::class);
        /** @var ValidatorMiddlewareFactory $validatorMiddlewareFactory */
        $validatorMiddlewareFactory = $container->get(ValidatorMiddlewareFactory::class);

        return new PipelineBuilder($application, $apiModel, $validatorMiddlewareFactory);
    }
}