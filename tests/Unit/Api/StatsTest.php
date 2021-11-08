<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Stats;
use SmartEmailing\Test\TestCase;

class StatsTest extends TestCase
{
    public function testShouldGetAllSentCampaigns(): void
    {
        $expectedArray = $this->getExpectedDataForCampaign();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('campaign-stats-sent', (new \SmartEmailing\Api\Model\Search\CampaignStats())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Stats $api */
        $response = $api->getCampaignSent(new \SmartEmailing\Api\Model\Search\CampaignStats());
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

    public function testShouldGetAllNewsletterSummary(): void
    {
        $expectedArray = $this->getExpectedDataForNewsletters();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('newsletter-stats-summary', (new \SmartEmailing\Api\Model\Search\NewsletterStats())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Stats $api */
        $response = $api->getNewsletterSummaries(new \SmartEmailing\Api\Model\Search\NewsletterStats());
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

    protected function getExpectedDataForCampaign(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                    "displayed_count": 1,
                    "total_count": 573,
                    "limit": 1,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 10,
                        "campaign_id": 5,
                        "contact_id": 1,
                        "time": "2015-08-02 02:00:54",
                        "emailaddress": "martin@smartemailing.cz",
                        "opened": true,
                        "clicked": false,
                        "unsubscribed": false,
                        "bounced": false
                    }
                ]
            }
        ';
    }

    protected function getExpectedDataForNewsletters(): string
    {
        return '
            {
               "status": "ok",
               "meta": {
                   "displayed_count": 1,
                   "total_count": 5,
                   "limit": 1,
                   "offset": 0
               },
               "data": [
                   {
                       "sent": 100,
                       "opened": 40,
                       "opened_not_unique": 50,
                       "clicked": 20,
                       "clicked_not_unique": 22,
                       "unsubscribed": 5,
                       "bounced": 0,
                       "id": 413,
                       "unopened": 60,
                       "unopened_perc": 60,
                       "opened_perc": 40,
                       "clicked_perc": 50,
                       "clicked_perc_abs": 20,
                       "unsubscribed_perc": 12.5,
                       "unsubscribed_perc_abs": 5,
                       "bounced_perc": 0,
                       "start": "2017-09-18 09:45:39",
                       "finish": "2017-09-18 09:48:02",
                       "name": "testing",
                       "email_id": 5,
                       "sms_id": null,
                       "preview_url": "https://app.smartemailing.cz/public/webversion/share-newsletter?u=cb2d679e-1cb3-4e08-9a7c-2561e80348c1&j=0efd62e0-4cb7-11e8-a424-305519813ba3",
                       "track": {
                           "utm_source": "newsletter",
                           "utm_medium": "email",
                           "utm_campaign": "campaign_413"
                       },
                       "contact_lists": [
                           {
                               "id": 1,
                               "name": "Name of contact lists"
                           },
                           {
                               "id": 2,
                               "name": "Second contact lists"
                           }
                       ]
                   }
               ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return Stats::class;
    }
}
