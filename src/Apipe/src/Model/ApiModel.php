<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 10.08.17
 * Time: 21:34
 */

namespace Apipe\Model;

use JMS\Serializer\Annotation as JmsAnnotation;

/**
 * Class ApiModel
 * @package Apipe\Model
 */
class ApiModel
{
    /**
     * @JmsAnnotation\Type("string")
     * @var string
     */
    private $versionControl;

    /**
     * @JmsAnnotation\Type("string")
     * @var string
     */
    private $errorHandler;

    /**
     * @JmsAnnotation\Type("string")
     * @var string
     */
    private $notFoundHandler;

    /**
     * @JmsAnnotation\Type("array")
     * @var array
     */
    private $settings;

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
     * @JmsAnnotation\Type("array<Apipe\Model\EndpointGroupModel>")
     * @var array
     */
    private $endpointGroups;

    /**
     * @return string
     */
    public function getVersionControl(): string
    {
        return $this->versionControl;
    }

    /**
     * @param string $versionControl
     */
    public function setVersionControl(string $versionControl)
    {
        $this->versionControl = $versionControl;
    }

    /**
     * @return string
     */
    public function getErrorHandler(): string
    {
        return $this->errorHandler;
    }

    /**
     * @param string $errorHandler
     */
    public function setErrorHandler(string $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    /**
     * @return string
     */
    public function getNotFoundHandler(): string
    {
        return $this->notFoundHandler;
    }

    /**
     * @param string $notFoundHandler
     */
    public function setNotFoundHandler(string $notFoundHandler)
    {
        $this->notFoundHandler = $notFoundHandler;
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
    public function getEndpointGroups(): array
    {
        return $this->endpointGroups;
    }

    /**
     * @param array $endpointGroups
     */
    public function setEndpointGroups(array $endpointGroups)
    {
        $this->endpointGroups = $endpointGroups;
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     */
    public function setSettings(array $settings)
    {
        $this->settings = $settings;
    }
}