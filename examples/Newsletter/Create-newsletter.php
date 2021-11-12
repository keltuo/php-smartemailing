<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\Api\Model\NewContactList;
use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Newsletter-Create_newsletter
 */
// new Model Instance
$newModel = new \SmartEmailing\Api\Model\Newsletter(
    48,
    [22,23],
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->newsletter()
    ->create($newModel);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 201,
  'status': 'created',
  'data': {
    'id': 838
  },
  'message': ''
}
 */
