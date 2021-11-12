<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Emails-Get_E_mails
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->emails()
    ->getList();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\Emails())
    ->selectBy(\SmartEmailing\Api\Model\Search\Emails::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\Emails::NAME)
    ->selectBy(\SmartEmailing\Api\Model\Search\Emails::HTML_BODY)
    ->sortBy(\SmartEmailing\Api\Model\Search\Emails::ID, \SmartEmailing\Api\Model\Search\Emails::SORT_DESC)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->emails()
    ->getList($search); // Get all with search filter

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
    'total_count': 243,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 469,
      'name': 'RDSGN - TOP-Pojištění - Akv - POV - Doba určitá - Připomínka',
      'htmlbody': "\u003c!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 ....."
    }
  ],
  'message': ''
}
 */
