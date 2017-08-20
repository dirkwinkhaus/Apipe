<?php

namespace Apipe\Action;

use Apipe\Exception\ResourceNotFoundException;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class AbstractArrayReturnActionTest
 * @package Apipe\Action
 */
class AbstractArrayReturnActionTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldDeliverTheList()
    {
        $action = new ArrayReturnAction($this->getConfigArray());

        /** @var ServerRequestInterface $serverRequestInterface */
        $serverRequestInterface = $this->prophesize(ServerRequestInterface::class)->reveal();

        /** @var DelegateInterface $delegateInterface */
        $delegateInterface = $this->prophesize(DelegateInterface::class)->reveal();

        $response = $action->process($serverRequestInterface, $delegateInterface);
        $content = $response->getBody()->getContents();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($this->getConfigJsonList(), $content);
    }

    /**
     * @test
     */
    public function itShouldDeliverOneEntity()
    {
        $action = new ArrayReturnAction($this->getConfigArray());

        /** @var ServerRequestInterface $serverRequestInterface */
        $serverRequestInterface = $this->prophesize(ServerRequestInterface::class);
        $serverRequestInterface->getAttribute('id', '')->willReturn(2);

        /** @var DelegateInterface $delegateInterface */
        $delegateInterface = $this->prophesize(DelegateInterface::class)->reveal();

        $response = $action->process($serverRequestInterface->reveal(), $delegateInterface);
        $content = $response->getBody()->getContents();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($this->getConfigJsonItem(), $content);
    }

    /**
     * @test
     */
    public function itShouldThrowException()
    {
        $this->expectException(ResourceNotFoundException::class);

        $action = new ArrayReturnAction($this->getConfigArray());

        /** @var ServerRequestInterface $serverRequestInterface */
        $serverRequestInterface = $this->prophesize(ServerRequestInterface::class);
        $serverRequestInterface->getAttribute('id', '')->willReturn(5);

        /** @var DelegateInterface $delegateInterface */
        $delegateInterface = $this->prophesize(DelegateInterface::class)->reveal();

        $response = $action->process($serverRequestInterface->reveal(), $delegateInterface);
    }

    /**
     * @return array
     */
    private function getConfigArray(): array
    {
        return [
            [
                'A' => 'B',
                'C' => 'D',
            ],
            [
                'E' => 'F',
                'G' => 'H',
            ],
        ];
    }

    /**
     * @return string
     */
    private function getConfigJsonList(): string
    {
        return '[{"A":"B","C":"D"},{"E":"F","G":"H"}]';
    }

    /**
     * @return string
     */
    private function getConfigJsonItem(): string
    {
        return '{"E":"F","G":"H"}';
    }
}