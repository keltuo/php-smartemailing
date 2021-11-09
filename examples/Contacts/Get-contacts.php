<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contacts-Get_Contacts_with_lists_and_customfield_values
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contacts()
    ->getList();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\Contacts())
    ->selectBy(\SmartEmailing\Api\Model\Search\Contacts::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\Contacts::NAME)
    ->selectBy(\SmartEmailing\Api\Model\Search\Contacts::EMAIL_ADDRESS)
    ->sortBy(\SmartEmailing\Api\Model\Search\Contacts::ID, \SmartEmailing\Api\Model\Search\Contacts::SORT_DESC)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contacts()
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
    'total_count': 465538,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 6715186,
      'name': 'Martin',
      'emailaddress': 'test@emailing.cz'
    }
  ],
  'message': ''
}
 */
