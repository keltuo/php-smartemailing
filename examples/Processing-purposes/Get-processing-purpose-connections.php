<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Processing_purposes-Get_Processing_purpose_connections
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->processingPurposes()
    ->getListConnections();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\PurposeConnections())
    ->selectBy(\SmartEmailing\Api\Model\Search\PurposeConnections::PURPOSE_ID)
    ->sortBy(\SmartEmailing\Api\Model\Search\PurposeConnections::ID, \SmartEmailing\Api\Model\Search\PurposeConnections::SORT_DESC)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->processingPurposes()
    ->getListConnections($search); // Get all with search filter

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
    'total_count': 46156,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'purpose_id': 9
    }
  ],
  'message': ''
}
FULL without filter
{
    'status': 'ok',
    'meta': {
        'displayed_count': 1,
        'total_count': 46156,
        'limit': 1,
        'offset': 0
    },
    'data': [
        {
            'id': 192,
            'created_at': '2018-04-22 21:08:30',
            'contact_id': 29806,
            'valid_from': '2015-08-11 14:52:49',
            'valid_to': '2015-12-11 14:52:49',
            'purpose_id': 2,
            'details': {
                'source': 'contactlist #3 connection'
            }
        }
    ]
}
 */
