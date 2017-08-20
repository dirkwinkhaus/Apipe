<?php

namespace Api\Address;

use Apipe\Config\ConfigProviderInterface;

/**
 * Class EndpointGroup
 * @package Api\Address
 */
class EndpointGroup implements ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'uri' => 'address',
            'before' => [
            ],
            'after' => [
            ],
            'endpoints' => [
                \Api\Address\ZipCode\Endpoint::class,
            ],
        ];
    }
}