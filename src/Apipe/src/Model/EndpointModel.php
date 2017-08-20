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
 * Class EndpointModel
 * @package Apipe\Model
 */
class EndpointModel
{
    /**
     * @JmsAnnotation\Type("integer")
     * @var int
     */
    private $currentVersion;

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
     * @JmsAnnotation\Type("array<Apipe\Model\EndpointVersionModel>")
     * @var array
     */
    private $versions;

    /**
     * @return int
     */
    public function getCurrentVersion(): int
    {
        return $this->currentVersion;
    }

    /**
     * @param int $currentVersion
     */
    public function setCurrentVersion(int $currentVersion)
    {
        $this->currentVersion = $currentVersion;
    }

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
     * @param mixed array
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
    public function getVersions(): array
    {
        return $this->versions;
    }

    /**
     * @param array $versions
     */
    public function setVersions(array $versions)
    {
        $this->versions = $versions;
    }
}