<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\ContactLists;
use SmartEmailing\Api\Model\ContactList;
use SmartEmailing\Api\Model\NewContactList;
use SmartEmailing\Test\TestCase;
use SmartEmailing\Util\Helpers;

class ContactListsTest extends TestCase
{
    public function testShouldCreateContactList(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": {
                "replyto": "replyto@smartemailing.cz",
                "clickRate": null,
                "hidden": 0,
                "alertOut": 0,
                "alertIn": 0,
                "category": null,
                "signature": null,
                "sendername": "Martin Strouhal",
                "segment_id": null,
                "name": "Internal name of this list",
                "openRate": null,
                "senderemail": "martin@smartemailing.cz",
                "id": 1,
                "notes": null,
                "trackedDefaultFields": "a:0:{}",
                "publicname": "Going public!",
                "created": "2017-06-13 17:55:25"
            }
        }';
        $newContactList = new NewContactList(
            'Internal name of this list',
            'Martin Strouhal',
            'martin@smartemailing.cz',
            'replyto@smartemailing.cz',
            'Going public!'
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('contactlists', $newContactList->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\ContactLists $api */
        $response = $api->create($newContactList);
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

    public function testShouldTruncate(): void
    {
        $expectedArray = '
        {
            "status": "ok",
            "meta": []
        }
        ';

        $uri = Helpers::replaceUrlParameters(
            'contactlists/:id/truncate',
            [
                'id' => 10
            ])
        ;
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($uri)
            ->will($this->returnValue(
                new Response(200))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->truncate(10);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldGetCountAddedContacts(): void
    {
        $expectedArray = '
            {
                "status": "ok",
                "meta": [
                 ],
                "data": {
                    "count": 5
                }
            }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with(Helpers::replaceUrlParameters('contactlists/:id/added-contacts', [
                'id' => 5
            ]))
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->getAddedContacts(5);
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

    public function testShouldGetAllContacts(): void
    {
        $expectedArray = $this->getExpectedArrayData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('contactlists', (new \SmartEmailing\Api\Model\Search\ContactLists())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->getList(new \SmartEmailing\Api\Model\Search\ContactLists());
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

    public function testShouldGetAllConfirmedContactsInList(): void
    {
        $expectedArray = $this->getExpectedArrayData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with(Helpers::replaceUrlParameters(
                'contactlists/:id/contacts/confirmed',
                [
                    'id' => 7
                ]
            ))
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->getAllConfirmedContacts(7);
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

    public function testShouldGetAllContactsInList(): void
    {
        $expectedArray = $this->getExpectedArrayData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with(Helpers::replaceUrlParameters(
                'contactlists/:id/contacts',
                [
                    'id' => 7
                ]
            ))
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->getAllContacts(7);
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

    public function testShouldGetAllUnsubscribeContactsInList(): void
    {
        $expectedArray = $this->getExpectedArrayData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with(Helpers::replaceUrlParameters(
                'contactlists/:id/contacts/unsubscribed',
                [
                    'id' => 7
                ]
            ))
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->getAllUnsubscribedContacts(7);
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

    public function testShouldGetSingle(): void
    {
        $expectedArray = '
        {
            "status": "ok",
            "meta": [
             ],
            "data": {
                "replyto": "martin@smartemailing.cz",
                "clickRate": null,
                "hidden": 0,
                "alertOut": 0,
                "alertIn": 0,
                "category": null,
                "signature": null,
                "sendername": "Martin Strouhal",
                "segment_id": null,
                "name": "martin@smartemailing.cz",
                "openRate": null,
                "senderemail": "martin@smartemailing.cz",
                "id": 1,
                "notes": null,
                "trackedDefaultFields": "a:0:{}",
                "publicname": "martin@smartemailing.cz",
                "created": "2015-07-21 17:55:25"
            }
        }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with(Helpers::replaceUrlParameters('contactlists/:id', [
                'id' => 1
            ]))
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->getSingle(1);
        $expectedObject = json_decode($expectedArray);
        $data = (array)$expectedObject->data;
        $this->assertEquals(
            $data,
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

    public function testShouldGetDistribution(): void
    {
        $expectedArray = '
        {
            "status": "ok",
            "meta": [
             ],
            "data": {
                "total": 5,
                "confirmed": 3,
                "unsubscribed": 2
            }
        }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with(Helpers::replaceUrlParameters('contactlists/:id/distribution', [
                'id' => 1
            ]))
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->getDistribution(1);
        $expectedObject = json_decode($expectedArray);
        $data = (array)$expectedObject->data;
        $this->assertEquals(
            $data,
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

    public function testShouldUpdate(): void
    {
        $expectedArray = '
        {
            "status": "ok",
            "meta": [],
            "data": {
                "replyto": "replyto@smartemailing.cz",
                "clickRate": null,
                "hidden": 0,
                "alertOut": 0,
                "alertIn": 0,
                "category": null,
                "signature": null,
                "sendername": "Martin Strouhal",
                "segment_id": null,
                "name": "Changed name",
                "openRate": null,
                "senderemail": "martin@smartemailing.cz",
                "id": 1,
                "notes": null,
                "trackedDefaultFields": "a:0:{}",
                "publicname": "Going public!",
                "created": "2017-06-13 17:55:25"
            }
        }
        ';

        $contactList = new ContactList(
            'Changed name'
        );
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with(Helpers::replaceUrlParameters('contactlists/:id', [
                'id' => 10
            ]), $contactList->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ContactLists $api */
        $response = $api->update(10, $contactList);
        $expectedObject = json_decode($expectedArray);
        $data = (array)$expectedObject->data;
        $this->assertEquals(
            $data,
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

    protected function getExpectedArrayData(): string
    {
        return '
        {
            "status": "ok",
            "meta": {
                "total_count": 21,
                "displayed_count": 2,
                "offset": 0,
                "limit": 2
            },
            "data": [
                {
                    "replyto": "martin@smartemailing.cz",
                    "clickRate": null,
                    "hidden": 0,
                    "alertOut": 0,
                    "alertIn": 0,
                    "category": null,
                    "signature": null,
                    "sendername": "Martin Strouhal",
                    "segment_id": null,
                    "name": "martin@smartemailing.cz",
                    "openRate": null,
                    "senderemail": "martin@smartemailing.cz",
                    "id": 1,
                    "notes": null,
                    "trackedDefaultFields": "a:0:{}",
                    "publicname": "martin@smartemailing.cz",
                    "created": "2015-07-21 17:55:25"
                },
                {
                    "replyto": "martin@smartemailing.cz",
                    "clickRate": null,
                    "hidden": 0,
                    "alertOut": 0,
                    "alertIn": 0,
                    "category": null,
                    "signature": null,
                    "sendername": "Martin Strouhal",
                    "segment_id": null,
                    "name": "API TEST",
                    "openRate": null,
                    "senderemail": "martin@smartemailing.cz",
                    "id": 737,
                    "notes": null,
                    "trackedDefaultFields": "a:0:{}",
                    "publicname": null,
                    "created": "2015-09-10 11:31:25"
                }
            ]
        }
        ';
    }

    protected function getApiClass(): string
    {
        return \SmartEmailing\Api\ContactLists::class;
    }
}
