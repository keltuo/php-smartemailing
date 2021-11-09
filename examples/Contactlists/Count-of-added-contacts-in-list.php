<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Count_added_contacts_in_list
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->getAddedContacts(1);

// Get Response
var_dump($list->getData());
//array(1) {
//  'count' =>
//  int(8)
//}

//Response Object toString
echo (string)$list;
/*
{
  'statusCode': 200,
  'status': 'ok',
  'data': {
    'count': 8
  },
  'message': ''
}
*/
