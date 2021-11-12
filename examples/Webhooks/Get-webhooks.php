<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Webhooks-Get_Webhooks
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->webhooks()
    ->getList();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\Webhooks())
    ->selectBy(\SmartEmailing\Api\Model\Search\Webhooks::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\Webhooks::EVENT)
    ->filterBy(
        \SmartEmailing\Api\Model\Search\Webhooks::URL,
        'http://example.com/notices/new_contact'
    )
    ->setLimit(1);
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->webhooks()
    ->getList($search);

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
    'total_count': 1,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 7,
      'event': 'new_contact'
    }
  ],
  'message': ''
}
 */
