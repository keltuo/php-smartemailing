<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Update_Customfield_option
 */
// new Model Instance
$customField = new \SmartEmailing\Api\Model\CustomFieldOption(
    119,
    4,
    'Change value 4'
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFieldOptions()
    ->update(20, $customField);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'data': {
    'id': 20,
    'customfield_id': 119,
    'name': 'Change value 4',
    'order': 4
  },
  'message': ''
}
 */
