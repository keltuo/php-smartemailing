<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Stats-Get_newsletter_stats_summaries
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->stats()
    ->getNewsletterSummaries();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\NewsletterStats())
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->stats()
    ->getNewsletterSummaries($search); // Get all with search filter

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
    'total_count': 523,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'sent': 1,
      'opened': 1,
      'opened_not_unique': 1,
      'clicked': 0,
      'clicked_not_unique': 0,
      'unsubscribed': 0,
      'id': 1,
      'unopened': 0,
      'unopened_perc': 0,
      'opened_perc': 100,
      'clicked_perc': 0,
      'clicked_perc_abs': 0,
      'unsubscribed_perc': 0,
      'unsubscribed_perc_abs': 0,
      'start': '2016-12-21 13:19:35',
      'finish': '2016-12-21 13:22:12',
      'name': 'PF 2017',
      'email_id': 1,
      'bounced': 0,
      'bounced_perc': 0,
      'preview_url': 'https://..wsletter?u\u003dc...-002590a1e8b2',
      'contact_lists': [
        {
          'id': 9,
          'name': 'SmartEmailing DEV _ Matin'
        }
      ]
    }
  ],
  'message': ''
}
 */
