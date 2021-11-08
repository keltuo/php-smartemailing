<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\CustomFields;
use SmartEmailing\Api\Model\CustomField;
use SmartEmailing\Api\Model\Response\BaseResponse;
use SmartEmailing\Test\TestCase;
use SmartEmailing\Util\Helpers;

class CustomFieldsTest extends TestCase
{
    public function testShouldCreateCustomField(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": {
                "id": 10,
                "options": null,
                "name": "Fruit",
                "type": "text"
            }
        }';
        $customField = new CustomField('Fruit', CustomField::TEXT);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('customfields', $customField->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\CustomFields $api */
        $response = $api->create($customField);
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

    public function testShouldRemove(): void
    {
        $expectedArray = '';

        $uri = Helpers::replaceUrlParameters(
            'customfields/:id',
            [
                'id' => 10
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

        /** @var CustomFields $api */
        $response = $api->remove(10);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            BaseResponse::HTTP_NOT_CONTENT_CODE,
            $response->getStatusCode()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldGetContactCustomFields(): void
    {
        $expectedArray = '
            {
                "status": "ok",
                "meta": {
                    "total_count": 4006,
                    "displayed_count": 2,
                    "offset": 0,
                    "limit": 2
                },
                "data": [
                    {
                        "customfield_id": 4,
                        "id": 243988,
                        "customfield_options_id": null,
                        "value": "Dr. No",
                        "contact_id": 35688
                    },
                    {
                        "customfield_id": 8,
                        "id": 243989,
                        "customfield_options_id": 123,
                        "value": null,
                        "contact_id": 35688
                    }
                ]
            }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('contact-customfields', (
                new \SmartEmailing\Api\Model\Search\ContactCustomFields())
                    ->setLimit(2)
                    ->toArray()
            )
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var CustomFields $api */
        $response = $api->getContactCustomFields(
            (new \SmartEmailing\Api\Model\Search\ContactCustomFields())
                ->setLimit(2)
        );
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            (array)$expectedObject->data,
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

    public function testShouldGetCustomFields(): void
    {
        $expectedArray = '
            {
                "status": "ok",
                "meta": {
                    "total_count": 8,
                    "displayed_count": 2,
                    "offset": 0,
                    "limit": 2
                },
                "data": [
                    {
                        "id": 1,
                        "customfield_options_url": "http://app.stormspire.loc/api/v3/customfield-options?customfield_id=1",
                        "name": "my select",
                        "type": "select"
                    },
                    {
                        "id": 2,
                        "customfield_options_url": "http://app.stormspire.loc/api/v3/customfield-options?customfield_id=2",
                        "name": "my checkbox",
                        "type": "checkbox"
                    }
                ]
            }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('customfields', (
            new \SmartEmailing\Api\Model\Search\CustomFields())
                ->toArray()
            )
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var CustomFields $api */
        $response = $api->getList(
            (new \SmartEmailing\Api\Model\Search\CustomFields())
        );
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
            "meta": [],
            "data": {
                "id": 1,
                "customfield_options_url": "http://app.stormspire.loc/api/v3/customfield-options?customfield_id=1",
                "name": "select",
                "type": "select"
            }
        }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('customfields/1')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var CustomFields $api */
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

    protected function getApiClass(): string
    {
        return \SmartEmailing\Api\CustomFields::class;
    }
}
