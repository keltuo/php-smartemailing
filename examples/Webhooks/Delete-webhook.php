<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Webhooks-Deletes_webhook
 */

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->webhooks()
    ->remove(7);

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
