<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 13.08.17
 * Time: 23:16
 */

namespace Apipe\Exception;

use Exception;

/**
 * Class VerbUnknownException
 * @package Apipe\Exception
 */
class VerbUnknownException
    extends Exception implements ApipeExceptionInterface
{
    /**
     * VerbUnknownException constructor.
     * @param string $verb
     */
    public function __construct($verb)
    {
        parent::__construct('Verb not known: ' . $verb, 500);
    }
}