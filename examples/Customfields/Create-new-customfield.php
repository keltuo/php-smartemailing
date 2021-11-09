<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Create_new_Customfield
 */
// new Model Instance
$newCustomField = new \SmartEmailing\Api\Model\CustomField(
    'Fruit',
    \SmartEmailing\Api\Model\CustomField::TEXT,
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFields()
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
    'name': 'Fruit',
    'type': 'text',
    'id': 121
  },
  'message': ''
}
 */
