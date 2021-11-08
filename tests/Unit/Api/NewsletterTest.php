<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Model\Newsletter;
use SmartEmailing\Test\TestCase;

class NewsletterTest extends TestCase
{
    public function testShouldCreateNewsletter(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": {"id": 1}
        }';
        $newsletter = (new Newsletter(1, [1,2]))
            ->setPropertiesFromArr(json_decode('
                {
                    "name": "My awesome newsletter",
                    "email_id": 1,
                    "contact_lists": [1,2],
                    "excluded_contact_lists": [3],
                    "measure_stats": true,
                    "sendOnPreferredTime": false,
                    "sender_email": "john.doe@smartemailing.cz",
                    "sender_name": "John Doe",
                    "reply_to": "john.doe@smartemailing.cz"
                }
            ', true));

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('newsletter', $newsletter->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\Newsletter $api */
        $response = $api->create($newsletter);
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

    protected function getApiClass(): string
    {
        return \SmartEmailing\Api\Newsletter::class;
    }
}
