<?php


namespace Api\Address\ZipCode;

use Apipe\Config\ConfigProviderInterface;

/**
 * Class Endpoint
 * @package Api\Address\ZipCode
 */
class Endpoint implements ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
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
        ];
    }
}