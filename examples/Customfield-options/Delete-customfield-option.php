<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Delete_Customfield
 */

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFieldOptions()
    ->remove(25);

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
