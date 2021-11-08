<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\TransactionalEmails;
use SmartEmailing\Test\TestCase;

class TransactionalEmailsTest extends TestCase
{
    public function testShouldGetAllCreated(): void
    {
        $expectedArray = $this->getExpectedData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('transactional-emails-ids')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var TransactionalEmails $api */
        $response = $api->getListCreated();
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            (array)$expectedObject->data,
            $response->getData()
        );
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

    protected function getExpectedData(): string
    {
        return '
            {
                "status": "ok",
                "meta": {},
                "data": {
                    "Example tag name": 1,
                    "Another tag name": 2
                }
            }
        ';
    }

    protected function getApiClass(): string
    {
        return TransactionalEmails::class;
    }
}
