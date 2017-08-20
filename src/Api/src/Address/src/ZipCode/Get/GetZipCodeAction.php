<?php

namespace Api\Address\ZipCode\Get;

use Apipe\Action\AbstractArrayReturnAction;

/**
 * Class GetZipCodeAction
 * @package App\Action
 *
 * @author Dirk Winkhaus <dirkwinkhaus@googlemail.com>
 */
class GetZipCodeAction extends AbstractArrayReturnAction
{
    /**
     * GetZipCodeAction constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct(
            [
                [
                    'id' => 1,
                    'zip' => 22589,
                    'city' => 'Hamburg',
                ],
                [
                    'id' => 2,
                    'zip' => 58762,
                    'city' => 'Altena',
                ],
            ]
        );
    }
}
