<?php

namespace Apipe\Config;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ApipeConfigTest
 * @package Apipe\Config
 */
class ApipeConfigTest extends TestCase
{
    /**
     * @test
     */
    public function itShould()
    {
        $apipeConfig =
            new ApipeConfig(
                $this->getFileSystemProphecy()->reveal(),
                $this->getConfigDissolverProphecy()->reveal(),
                $this->getConfig()
            );

        $config = $apipeConfig->getConfig();

        $this->assertEquals($this->getConfig(), $config);
    }

    /**
     * @return ObjectProphecy
     */
    private function getFileSystemProphecy(): ObjectProphecy
    {
        return $this->prophesize(Filesystem::class);
    }

    /**
     * @return ObjectProphecy
     */
    private function getConfigDissolverProphecy(): ObjectProphecy
    {
        return $this->prophesize(ConfigDissolver::class);
    }

    /**
     * @return array
     */
    private function getConfig()
    {
        return [];
    }
}