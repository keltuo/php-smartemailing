<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contacts-Forget_contact
 */

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contacts()
    ->forgetContact(4209629); // be careful. see docs

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 204,
  'status': 'ok',
  'data': [],
  'message': ''
}
 */
