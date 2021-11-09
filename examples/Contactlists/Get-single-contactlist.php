<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Get_single_Contactlist
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->getSingle(1); // Returns single without filter

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\ContactLists())
    ->selectBy(\SmartEmailing\Api\Model\Search\ContactLists::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\ContactLists::NAME);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->getSingle(1, $search); // Get single with filtered fields

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'data': {
    'id': 1,
    'name': 'Databáze klientů 2016-11-09'
  },
  'message': ''
}
 */
