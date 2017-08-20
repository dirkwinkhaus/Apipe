<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 10.08.17
 * Time: 21:37
 */

namespace Apipe\Model;

use JMS\Serializer\Annotation as JmsAnnotation;

/**
 * Class EndpointVersionModel
 * @package Apipe\Model
 */
class EndpointVersionModel
{
    /**
     * @JmsAnnotation\Type("array<string>")
     * @var array
     */
    private $before;

    /**
     * @JmsAnnotation\Type("array<string>")
     * @var array
     */
    private $after;

    /**
     * @JmsAnnotation\Type("Apipe\Model\ParameterModel")
     * @var ParameterModel
     */
    private $parameter;

    /**
     * @JmsAnnotation\Type("array")
     * @var array
     */
    private $allowedVerbs;

    /**
     * @return array
     */
    public function getBefore(): array
    {
        return $this->before;
    }

    /**
     * @param array $before
     */
    public function setBefore(array $before)
    {
        $this->before = $before;
    }

    /**
     * @return array
     */
    public function getAfter(): array
    {
        return $this->after;
    }

    /**
     * @param array $after
     */
    public function setAfter(array $after)
    {
        $this->after = $after;
    }

    /**
     * @return array
     */
    public function getAllowedVerbs(): array
    {
        return $this->allowedVerbs;
    }

    /**
     * @param mixed $allowedVerbs
     */
    public function setAllowedVerbs(array $allowedVerbs)
    {
        $this->allowedVerbs = $allowedVerbs;
    }

    /**
     * @return array
     */
    public function getParameter(): ?ParameterModel
    {
        return $this->parameter;
    }

    /**
     * @param ParameterModel $parameter
     */
    public function setParameter(ParameterModel $parameter)
    {
        $this->parameter = $parameter;
    }
}