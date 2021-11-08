<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\CustomFieldOptions;
use SmartEmailing\Api\Model\CustomFieldOption;
use SmartEmailing\Api\Model\Response\BaseResponse;
use SmartEmailing\Test\TestCase;
use SmartEmailing\Util\Helpers;

class CustomFieldOptionsTest extends TestCase
{
    public function testShouldCreateCustomField(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": {
                "customfield_id": 1,
                "id": 10,
                "order": 6,
                "name": "Tokyo"
            }
        }';
        $customField = new CustomFieldOption(1, 6, 'Tokyo');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('customfield-options', $customField->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\CustomFieldOptions $api */
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
            'customfield-options/:id',
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

        /** @var CustomFieldOptions $api */
        $response = $api->remove(10);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            BaseResponse::HTTP_NOT_CONTENT_CODE,
            $response->getStatusCode()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldGetCustomFieldOptions(): void
    {
        $expectedArray = '
            {
                "status": "ok",
                "meta": {
                    "displayed_count": 2,
                    "total_count": 9,
                    "limit": 2,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 1,
                        "customfield_id": 1,
                        "name": "London",
                        "order": 0
                    },
                    {
                        "id": 2,
                        "customfield_id": 1,
                        "name": "Krasnoyarsk",
                        "order": 1
                    }
                ]
            }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('customfield-options',
                (new \SmartEmailing\Api\Model\Search\CustomFieldOptions())
                    ->setLimit(2)
                ->toArray()
            )
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var CustomFieldOptions $api */
        $response = $api->getList(
            (new \SmartEmailing\Api\Model\Search\CustomFieldOptions())
                ->setLimit(2)
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
                "customfield_id": 1,
                "name": "1",
                "order": 0
            }
        }
        ';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('customfield-options/1')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var CustomFieldOptions $api */
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

    public function testShouldUpdate(): void
    {
        $expectedArray = '
        {
            "status": "ok",
            "meta": [],
            "data": {
                "customfield_id": 1,
                "id": 10,
                "order": 6,
                "name": "Washington"
            }
        }
        ';
        $customField = new CustomFieldOption(1, 6, 'Washington');
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('patch')
            ->with('customfield-options/10', $customField->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var CustomFieldOptions $api */
        $response = $api->update(10, $customField);
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
        return \SmartEmailing\Api\CustomFieldOptions::class;
    }
}
