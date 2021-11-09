<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Get_Customfield_options
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFieldOptions()
    ->getList();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\CustomFieldOptions())
    ->selectBy(\SmartEmailing\Api\Model\Search\CustomFieldOptions::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\CustomFieldOptions::NAME)
    ->sortBy(\SmartEmailing\Api\Model\Search\CustomFieldOptions::ID, \SmartEmailing\Api\Model\Search\CustomFieldOptions::SORT_DESC)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFieldOptions()
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
    'total_count': 10,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 20,
      'name': 'Test hodnota 4'
    }
  ],
  'message': ''
}
 */
