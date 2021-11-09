<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\Response\BaseResponse as Response;
use SmartEmailing\Api\Model\Search\NewsletterStats as SearchNewsletterStats;
use SmartEmailing\Api\Model\Search\CampaignStats as SearchCampaignStats;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-Stats
 * @package SmartEmailing\Api
 */
class Stats extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Stats-Get_campaign_sent_stats
     */
    public function getCampaignSent(SearchCampaignStats $search = null): Response
    {
        $search = $search ?? new SearchCampaignStats();
        return new Response($this->get('campaign-stats-sent', $search->getAsQuery()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Stats-Get_newsletter_stats_summaries
     */
    public function getNewsletterSummaries(SearchNewsletterStats $search = null): Response
    {
        $search = $search ?? new SearchNewsletterStats();
        return new Response($this->get('newsletter-stats-summary', $search->getAsQuery()));
    }
}
