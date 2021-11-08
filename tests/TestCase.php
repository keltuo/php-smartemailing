<?php
declare(strict_types=1);

namespace SmartEmailing\Test;

use GuzzleHttp\Client;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Http\Message\ResponseInterface;
use SmartEmailing\SmartEmailing;
use function array_merge;

abstract class TestCase extends BaseTestCase
{
    abstract protected function getApiClass(): string;

    protected mixed $defaultReturnResponse;

    protected function setUp(): void
    {
        parent::setUp();
        $this->defaultReturnResponse = '{
               "status": "ok",
               "meta": [
               ],
               "message": "Hi there! API version 3 here!"
           }';
    }

    /**
     * @param array $methods
     *
     * @return MockObject
     */
    protected function getApiMock(array $methods = []): MockObject
    {
        $client = $this->createMock(Client::class);
        $api = $this->getMockBuilder(SmartEmailing::class)
            ->onlyMethods(['getClient'])
            ->setConstructorArgs(['username', 'api-key'])
            ->getMock();
        $api
            ->expects($this->any())
            ->method('getClient')
            ->willReturn($client);

        return $this->getMockBuilder($this->getApiClass())
            ->onlyMethods(array_merge(['get', 'post', 'patch', 'delete', 'put'], $methods))
            ->setConstructorArgs([$api])
            ->getMock();
    }
}
