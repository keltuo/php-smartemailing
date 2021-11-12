<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Processing_purposes-Revoke_Processing_purpose_connection
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->processingPurposes()
    ->revoke(244627);


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
