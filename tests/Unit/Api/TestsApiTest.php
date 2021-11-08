<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Model\LoginResponse;
use SmartEmailing\Api\Tests;
use SmartEmailing\Test\TestCase;

class TestsApiTest extends TestCase
{
    public function testAliveness(): void
    {
        $expectedArray = $this->getExpectedAliveness();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('ping')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Tests $api */
        $response = $api->aliveness();
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            empty($expectedObject->meta) ? null :$expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldGetLogin(): void
    {
        $this->loginTest('get');
    }

    public function testShouldPostLogin(): void
    {
        $this->loginTest('post');
    }

    protected function getExpectedAliveness(): string
    {
        return '
            {
               "status": "ok",
               "meta": [
               ],
               "message": "Hi there! API version 3 here!"
           }
        ';
    }

    protected function getExpectedLogin(): string
    {
        return '
            {
                "status": "ok",
                "meta": [
                ],
                "message": "Hi there! Your credentials are valid!",
                "account_id": 2
            }
        ';
    }

    protected function getApiClass(): string
    {
        return Tests::class;
    }

    protected function loginTest($method): void
    {
        $expectedArray = $this->getExpectedLogin();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method($method)
            ->with('check-credentials')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            );

        /** @var Tests $api */
        $method = $method . 'Login';
        /** @var LoginResponse $response */
        $response = $api->{$method}();
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->account_id,
            $response->getAccountId()
        );
        $this->assertEquals(
            empty($expectedObject->meta) ? null : $expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }
}
