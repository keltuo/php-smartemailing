<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Model\Webhook;
use SmartEmailing\Api\Webhooks;
use SmartEmailing\Test\TestCase;
use SmartEmailing\Util\Helpers;

class WebhooksTest extends TestCase
{
    public function testShouldGetAllWebhooks(): void
    {
        $expectedArray = $this->getExpectedData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('web-hooks', (new \SmartEmailing\Api\Model\Search\Webhooks())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Webhooks $api */
        $response = $api->getList(new \SmartEmailing\Api\Model\Search\Webhooks());
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->data,
            $response->getData()
        );
        $this->assertEquals(
            $expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldCreateWebhook(): void
    {
        $expectedArray = '{
            "id": 123,
            "status": "created",
            "meta": {}
        }';
        $webhook = new Webhook('http://test.cz', Webhook::EVENT_SENT_EMAIL);
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('web-hooks', $webhook->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var Webhooks $api */
        $response = $api->create($webhook);
        $expectedObject = json_decode($expectedArray);
        $this->assertFalse(
            isset($expectedObject->data),
        );
        $this->assertEquals(
            $expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldRemoveWebhook(): void
    {
        $expectedArray = $this->getExpectedData();

        $uri = Helpers::replaceUrlParameters(
            'web-hooks/:id',
            [
                'id' => 1
            ])
        ;
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($uri)
            ->will($this->returnValue(
                new Response(204))
            )
        ;

        /** @var Webhooks $api */
        $response = $api->remove(1);
        $expectedObject = json_decode($expectedArray);
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
                "meta": {
                    "displayed_count": 1,
                    "total_count": 1,
                    "limit": 500,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 1,
                        "url": "http://smartemailing.dev/",
                        "method": "POST",
                        "event": "new_contact",
                        "active": true,
                        "timeout": 30,
                        "last_response_code": 200,
                        "last_call_time": "2017-05-16 12:34:56",
                        "errors_in_row": 0
                    }
                ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return Webhooks::class;
    }
}
