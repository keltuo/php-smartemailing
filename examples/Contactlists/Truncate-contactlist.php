<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Truncate_Contactlist
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->truncate(769); // Truncate all contacts in contact lists

// Get Response
var_dump($list->getStatus());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'data': [],
  'message': ''
}
 */
