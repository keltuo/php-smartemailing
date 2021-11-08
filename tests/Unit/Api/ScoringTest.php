<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Scoring;
use SmartEmailing\Test\TestCase;

class ScoringTest extends TestCase
{
    public function testShouldGetResultHistory(): void
    {
        $expectedArray = $this->getExpectedDataForScoring();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('scoring-result-changes', [])
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Scoring $api */
        $response = $api->resultHistory([]);
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

    protected function getExpectedDataForScoring(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                    "displayed_count": 2,
                    "total_count": 2,
                    "limit": 2,
                    "offset": 0
                },
                "data": [
                    {
                        "id": "11e99772e86957a297376c4008be149e",
                        "created_at": "2019-06-25 19:58:59",
                        "contact_id": 1,
                        "score": 312.5,
                        "scoring_id": "11e93031737cb37eaf866c4008be149e",
                        "scoring_name": "E-mail engagement score"
                    },
                    {
                        "id": "11e997729c9e7a288d306c4008be149e",
                        "created_at": "2019-06-25 19:56:52",
                        "contact_id": 1,
                        "score": 520.4,
                        "scoring_id": "11e93031737cb37eaf866c4008be149e",
                        "scoring_name": "E-mail engagement score"
                    }
                ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return Scoring::class;
    }
}
