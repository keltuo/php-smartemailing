<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Model\Period;
use SmartEmailing\Api\Model\Purpose;
use SmartEmailing\Api\Model\Response\BaseResponse;
use SmartEmailing\Api\ProcessingPurposes;
use SmartEmailing\Test\TestCase;
use SmartEmailing\Util\Helpers;

class ProcessingPurposesTest extends TestCase
{
    public function testShouldGetAll(): void
    {
        $expectedArray = $this->getExpectedDataForGetAll();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('purposes', (new \SmartEmailing\Api\Model\Search\Purposes())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ProcessingPurposes $api */
        $response = $api->getList(new \SmartEmailing\Api\Model\Search\Purposes());
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

    public function testShouldGetAllConnections(): void
    {
        $expectedArray = $this->getExpectedDataForGetAllConnections();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('purpose-connections', (new \SmartEmailing\Api\Model\Search\PurposeConnections())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var ProcessingPurposes $api */
        $response = $api->getListConnections(new \SmartEmailing\Api\Model\Search\PurposeConnections());
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

    public function testShouldCreatePurpose(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": {
                "id": 9,
                "created_at": "2018-04-19 00:51:37",
                "lawful_basis": "contract",
                "name": "Pizza delivery",
                "duration": {
                    "value": 10,
                    "unit": "days"
                },
                "notes": null
            }
        }';
        $purpose = new Purpose(
            Purpose::LAWFUL_CONTRACT,
            'Pizza delivery',
            new Period(Period::DAYS, 10)
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('purposes', $purpose->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var ProcessingPurposes $api */
        $response = $api->create($purpose);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals($purpose->getLawfulBasis(), $response->getData()['lawful_basis']);
        $this->assertEquals($purpose->getName(), $response->getData()['name']);
        $this->assertEquals($purpose->getNotes(), $response->getData()['notes']);
        $this->assertEquals(
            !is_object($expectedObject->meta) ? null : $expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldRevokeConnections(): void
    {
        $uri = Helpers::replaceUrlParameters(
            'purpose-connections/:id',
            [
                'id' => 1
            ]
        )
        ;
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($uri)
            ->will($this->returnValue(
                new Response(204))
            )
        ;

        /** @var ProcessingPurposes $api */
        $response = $api->revoke(1);
        $this->assertEquals(
            BaseResponse::HTTP_NOT_CONTENT_CODE,
            $response->getResponse()->getStatusCode()
        );
        $this->assertEquals(
            BaseResponse::SUCCESS,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    protected function getExpectedDataForGetAll(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                    "displayed_count": 2,
                    "total_count": 8,
                    "limit": 2,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 1,
                        "created_at": "2018-03-25 23:20:00",
                        "lawful_basis": "consent",
                        "name": "Newsletter delivery",
                        "duration": {
                            "value": 1,
                            "unit": "years"
                        },
                        "notes": null
                    },
                    {
                        "id": 2,
                        "created_at": "2018-03-25 23:20:19",
                        "lawful_basis": "contract",
                        "name": "Paid cooking class videos delivery",
                        "duration": {
                            "value": 30,
                            "unit": "days"
                        },
                        "notes": null
                    }
                ]
            }
        ';
    }

    protected function getExpectedDataForGetAllConnections(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                    "displayed_count": 2,
                    "total_count": 8,
                    "limit": 2,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 1,
                        "created_at": "2018-03-25 23:20:00",
                        "lawful_basis": "consent",
                        "name": "Newsletter delivery",
                        "duration": {
                            "value": 1,
                            "unit": "years"
                        },
                        "notes": null
                    },
                    {
                        "id": 2,
                        "created_at": "2018-03-25 23:20:19",
                        "lawful_basis": "contract",
                        "name": "Paid cooking class videos delivery",
                        "duration": {
                            "value": 30,
                            "unit": "days"
                        },
                        "notes": null
                    }
                ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return ProcessingPurposes::class;
    }
}
