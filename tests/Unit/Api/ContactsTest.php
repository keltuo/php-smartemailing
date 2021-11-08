<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Contacts;
use SmartEmailing\Api\Model\ChangeEmailAddress;
use SmartEmailing\Api\Model\Response\BaseResponse;
use SmartEmailing\Test\TestCase;
use SmartEmailing\Util\Helpers;

class ContactsTest extends TestCase
{
    public function testShouldChangeEmail(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": []
        }';
        $changeEmailAddress = new ChangeEmailAddress(
            'martin@smartemailing.cz',
            'spock@smartemailing.cz'
        );
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('change-emailaddress', $changeEmailAddress->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var Contacts $api */
        $response = $api->changeEmailAddress($changeEmailAddress);
        $expectedObject = json_decode($expectedArray);
        $this->assertFalse(
            isset($expectedObject->data),
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
        $expectedArray = $this->getExpectedData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('contacts', (new \SmartEmailing\Api\Model\Search\Contacts())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Contacts $api */
        $response = $api->getList(new \SmartEmailing\Api\Model\Search\Contacts());
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

    public function testShouldForgetContact(): void
    {
        $expectedArray = '';

        $uri = Helpers::replaceUrlParameters(
            'contacts/forget/:id',
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

        /** @var Contacts $api */
        $response = $api->forgetContact(1);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            BaseResponse::HTTP_NOT_CONTENT_CODE,
            $response->getStatusCode()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldGetSingleContact(): void
    {
        $expectedArray = $this->getExpectedSingleData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('contacts/5')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Contacts $api */
        $response = $api->getSingle(5);
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

    protected function getExpectedSingleData(): string
    {
        return '
        {
            "status": "ok",
            "meta": [
            ],
            "data": {
                "company": null,
                "street": null,
                "country": null,
                "id": 29678,
                "created": "2015-08-11 14:52:49",
                "updated": null,
                "last_clicked": null,
                "softbounced": 0,
                "nameday": null,
                "hardbounced": 0,
                "realname": null,
                "emailaddress": "testmail_123@g4it.cz",
                "surname": null,
                "cellphone": null,
                "birthday": null,
                "name": null,
                "salution": null,
                "domain": "g4it.cz",
                "customfields_url": "https://app.smartemailing.cz/api/v3/contact-customfields?contact_id=29678",
                "contactlists": [
                    {
                        "status": "confirmed",
                        "updated": null,
                        "id": 30286,
                        "score_clicks": null,
                        "added": "2016-02-15 23:28:16",
                        "score_opens": null,
                        "contactlist_id": 770,
                        "contact_id": 29678
                    },
                    {
                        "status": "confirmed",
                        "updated": null,
                        "id": 36233,
                        "score_clicks": null,
                        "added": "2016-09-13 00:25:25",
                        "score_opens": null,
                        "contactlist_id": 779,
                        "contact_id": 29678
                    },
                    {
                        "status": "confirmed",
                        "updated": null,
                        "id": 45540,
                        "score_clicks": null,
                        "added": "2016-09-20 04:04:31",
                        "score_opens": null,
                        "contactlist_id": 782,
                        "contact_id": 29678
                    }
                ],
                "titlesbefore": null,
                "blacklisted": 0,
                "last_opened": null,
                "town": null,
                "gender": null,
                "titlesafter": null,
                "postalcode": null,
                "affilid": null,
                "language": "cs_CZ",
                "phone": null,
                "guid": "df2198a1-4027-11e5-8cf3-002590a1e85a",
                "notes": null,
                "preferredDeliveryTime": null
            }
        }
        ';
    }

    protected function getExpectedData(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                    "total_count": 5020,
                    "displayed_count": 2,
                    "offset": 0,
                    "limit": 2
                },
                "data": [
                    {
                        "company": null,
                        "street": null,
                        "country": null,
                        "id": 29678,
                        "created": "2015-08-11 14:52:49",
                        "updated": null,
                        "last_clicked": null,
                        "softbounced": 0,
                        "nameday": null,
                        "hardbounced": 0,
                        "realname": null,
                        "emailaddress": "testmail_123@g4it.cz",
                        "surname": null,
                        "cellphone": null,
                        "birthday": null,
                        "name": null,
                        "salution": null,
                        "domain": "g4it.cz",
                        "customfields_url": "https://app.smartemailing.cz/api/v3/contact-customfields?contact_id=29678",
                        "contactlists": [
                            {
                                "status": "confirmed",
                                "updated": null,
                                "id": 30286,
                                "score_clicks": null,
                                "added": "2016-02-15 23:28:16",
                                "score_opens": null,
                                "contactlist_id": 770,
                                "contact_id": 29678
                            },
                            {
                                "status": "confirmed",
                                "updated": null,
                                "id": 36233,
                                "score_clicks": null,
                                "added": "2016-09-13 00:25:25",
                                "score_opens": null,
                                "contactlist_id": 779,
                                "contact_id": 29678
                            },
                            {
                                "status": "confirmed",
                                "updated": null,
                                "id": 45540,
                                "score_clicks": null,
                                "added": "2016-09-20 04:04:31",
                                "score_opens": null,
                                "contactlist_id": 782,
                                "contact_id": 29678
                            }
                        ],
                        "titlesbefore": null,
                        "blacklisted": 0,
                        "last_opened": null,
                        "town": null,
                        "gender": null,
                        "titlesafter": null,
                        "postalcode": null,
                        "affilid": null,
                        "language": "cs_CZ",
                        "phone": null,
                        "guid": "df2198a1-4027-11e5-8cf3-002590a1e85a",
                        "notes": null,
                        "preferredDeliveryTime": null
                    }
                ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return Contacts::class;
    }
}
