<?php

return [
    'apipe' => [
        'versionControl' => \Apipe\Config\HeadVersionControlInterface::class,
        'errorHandler' => \Apipe\Middleware\ErrorHandler::class,
        'notFoundHandler' => \Apipe\Middleware\NotFoundHandler::class,
        'settings' => [
            'errorHandler' => [
                'showTrace' => true,
            ],
            'cache' => [
                'filePath' => './data',
                'enabled' => true,
        ],
        ],
        'before' => [
            \Api\Address\Service\Authorization::class,
        ],
        'after' => [
        ],
        'endpointGroups' => [
            \Api\Address\EndpointGroup::class,
        ],
    ],
];
