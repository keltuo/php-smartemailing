<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Processing_purposes-Get_Processing_purposes
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->processingPurposes()
    ->getList();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\Purposes())
    ->selectBy(\SmartEmailing\Api\Model\Search\Purposes::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\Purposes::NAME)
    ->selectBy(\SmartEmailing\Api\Model\Search\Purposes::DURATION)
    ->sortBy(\SmartEmailing\Api\Model\Search\Purposes::ID, \SmartEmailing\Api\Model\Search\Purposes::SORT_DESC)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->processingPurposes()
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
    'total_count': 4,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 10,
      'name': 'Pizza delivery',
      'duration': {
        'value': 30,
        'unit': 'days'
      }
    }
  ],
  'message': ''
}
 */
