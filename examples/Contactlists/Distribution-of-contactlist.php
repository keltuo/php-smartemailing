<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\Api\Model\NewContactList;
use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Count_contacts_in_list
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->getDistribution(1);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
  {
  'statusCode': 200,
  'status': 'ok',
  'data': {
    'total': 246437,
    'confirmed': 232372,
    'unsubscribed': 0
  },
  'message': ''
}
 */
