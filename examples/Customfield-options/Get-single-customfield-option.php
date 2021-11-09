<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Get_single_Customfield_option
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFieldOptions()
    ->getSingle(20); // Returns single without filter

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\CustomFieldOptions())
    ->selectBy(\SmartEmailing\Api\Model\Search\CustomFieldOptions::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\CustomFieldOptions::NAME);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customFieldOptions()
    ->getSingle(20, $search); // Get single with filtered fields

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
    'name': 'Test hodnota 4'
  },
  'message': ''
}
 */
