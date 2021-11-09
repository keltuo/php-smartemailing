<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Get_Customfields
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFields()
    ->getList();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\CustomFields())
    ->selectBy(\SmartEmailing\Api\Model\Search\CustomFields::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\CustomFields::NAME)
    ->sortBy(\SmartEmailing\Api\Model\Search\CustomFields::ID, \SmartEmailing\Api\Model\Search\CustomFields::SORT_DESC)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFields()
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
    'total_count': 41,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 119,
      'name': 'Test'
    }
  ],
  'message': ''
}
 */
