<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 10.08.17
 * Time: 21:36
 */

namespace Apipe\Model;

use JMS\Serializer\Annotation as JmsAnnotation;

/**
 * Class GroupModel
 * @package Apipe\Model
 */
class EndpointGroupModel
{
    /**
     * @JmsAnnotation\Type("string")
     * @var string
     */
    private $uri;

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
     * @JmsAnnotation\Type("array<Apipe\Model\EndpointModel>")
     * @var array
     */
    private $endpoints;

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

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
    public function getEndpoints(): array
    {
        return $this->endpoints;
    }

    /**
     * @param array $endpoints
     */
    public function setEndpoints(array $endpoints)
    {
        $this->endpoints = $endpoints;
    }
}