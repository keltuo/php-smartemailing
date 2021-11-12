<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Model\Bag\TriggerEventBag;
use SmartEmailing\Api\Model\Event;
use SmartEmailing\Test\TestCase;

class AutomationTest extends TestCase
{
    public function testShouldCreate(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": []
        }';
        $triggerEventBag = (new TriggerEventBag())
            ->add(new Event(
                'michal@smartemailing.cz',
                'filled-form',
                [
                    'form-name' => 'some form name',
                    'referer'=> 'google'
                ]
            ))
            ->add(new Event(
                'someone@smartemailing.cz',
                'someone@smartemailing.cz',
                [
                    'something' => 'test'
                ]
            ));

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('trigger-event', $triggerEventBag->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\Automation $api */
        $response = $api->triggerEvent($triggerEventBag);
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
        $this->assertNull($api->triggerEvent(new TriggerEventBag()));
    }

    protected function getApiClass(): string
    {
        return \SmartEmailing\Api\Automation::class;
    }
}
