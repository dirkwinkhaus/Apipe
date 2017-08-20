<?php

return [
    'dependencies' => [
        'factories' => [
            \Apipe\Routing\PipelineBuilder::class => \Apipe\Routing\PipelineBuilderFactory::class,
            \Apipe\Config\ApipeConfigInterface::class => \Apipe\Config\ApipeConfigFactory::class,
            \Apipe\Model\ApiModel::class => \Apipe\Model\ApiModelFactory::class,
            \Apipe\Middleware\ErrorHandler::class => \Apipe\Middleware\ErrorHandlerFactory::class,
            \Apipe\Middleware\NotFoundHandler::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Apipe\Middleware\ValidatorMiddlewareFactory::class => \Apipe\Middleware\ValidatorMiddlewareFactoryFactory::class,
            \Apipe\Validator\AnyValidator::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Apipe\Validator\ValidatorFactory::class => \Apipe\Validator\ValidatorFactoryFactory::class,
            \Apipe\Validator\InValidator::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Apipe\Config\ConfigDissolver::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Symfony\Component\Filesystem\Filesystem::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],
];
