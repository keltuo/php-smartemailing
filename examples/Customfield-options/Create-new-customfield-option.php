<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Create_new_Customfield_option
 */
// new Model Instance
$newCustomField = new \SmartEmailing\Api\Model\CustomFieldOption(
    119,
    5,
    'Tokyo'
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFieldOptions()
    ->create($newCustomField);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 201,
  'status': 'created',
  'data': {
    'id': 25,
    'customfield_id': 119,
    'name': 'Tokyo',
    'order': 5
  },
  'message': ''
}
 */
