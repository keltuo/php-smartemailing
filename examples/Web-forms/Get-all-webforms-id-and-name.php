<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Web_Forms-Get_all_Web_Form_ids_and_names
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->webForms()
    ->getList();

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'meta': {
    'displayed_count': 1,
    'total_count': 1,
    'limit': 500,
    'offset': 0
  },
  'data': [
    {
      'name': 'Test - výročí',
      'id': 2
    }
  ],
  'message': ''
}
 */
