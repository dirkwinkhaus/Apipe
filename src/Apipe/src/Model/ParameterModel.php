<?php

namespace Apipe\Model;

use JMS\Serializer\Annotation as JmsAnnotation;

/**
 * Class ParameterModel
 * @package Apipe\Model
 */
class ParameterModel
{
    /**
     * @var string[][]
     * @JmsAnnotation\Type("array")
     */
    private $required;

    /**
     * @var string[][]
     * @JmsAnnotation\Type("array")
     */
    private $optional;

    /**
     * @return string[]
     */
    public function getRequired(): array
    {
        return $this->required;
    }

    /**
     * @param string[] $required
     */
    public function setRequired(array $required)
    {
        $this->required = $required;
    }

    /**
     * @return string[]
     */
    public function getOptional(): array
    {
        return $this->optional;
    }

    /**
     * @param string[] $optional
     */
    public function setOptional(array $optional)
    {
        $this->optional = $optional;
    }
}