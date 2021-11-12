<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Stats-Get_campaign_sent_stats
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->stats()
    ->getCampaignSent();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\CampaignStats())
    ->selectByType(\SmartEmailing\Api\Model\Search\CampaignStats::CAMPAIGN_NEWSLETTER)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->stats()
    ->getCampaignSent($search); // Get all with search filter

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'meta': {
    'displayed_count': 1,
    'total_count': 6366972,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 1,
      'newsletter_id': 1,
      'contact_id': 49,
      'time': '2016-12-21 13:22:12',
      'emailaddress': 'matin@smartemailing.cz',
      'opened': true,
      'clicked': false,
      'unsubscribed': false,
      'bounced': false
    }
  ],
  'message': ''
}
 */
