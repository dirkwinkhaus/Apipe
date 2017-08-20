# Apipe on Expressive 
## Installation
## Configuration
### Sample
    <?php
    
    return [
        'apipe' => [
            'versionControl' => \Apipe\Config\HeadVersionControlInterface::class,
            'errorHandler' => \Apipe\ErrorHandler\ErrorHandler::class,
            'notFoundHandler' => \Apipe\ErrorHandler\NotFoundHandler::class,
            'settings' => [
                'errorHandler' => [
                    'showTrace' => true,
                ],
            ],
            'before' => [
                \Api\Address\Service\Authorization::class,
            ],
            'after' => [
            ],
            'endpointGroups' => [
                'address' => [
                    'uri' => 'address',
                    'before' => [
                    ],
                    'after' => [
                    ],
                    'endpoints' => [
                        'zipCode' => [
                            'currentVersion' => 0,
                            'uri' => 'zipcode',
                            'before' => [
                            ],
                            'after' => [
                            ],
                            'versions' => [
                                [
                                    'parameter' => [
                                        'required' => [
                                        ],
                                        'optional' => [
                                            'id' => [
                                                \Apipe\Validator\AnyValidator::class,
                                            ],
                                        ],
                                    ],
                                    'before' => [
                                    ],
                                    'after' => [
                                    ],
                                    'allowedVerbs' => [
                                        'get' => [
                                            \Api\Address\ZipCode\Get\GetZipCodeAction::class,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
