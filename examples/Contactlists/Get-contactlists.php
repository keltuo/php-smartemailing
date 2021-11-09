<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Get_Contactlists
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->getList(); // Returns all contact lists without filter

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\ContactLists())
    ->selectBy(\SmartEmailing\Api\Model\Search\ContactLists::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\ContactLists::NAME)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->getList($search); // Get all contact lists with search filter

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
    'total_count': 405,
    'limit': 1,
    'offset': 0
  },
  'data': [
    {
      'id': 1,
      'name': 'Databáze klientů 2016-11-09'
    }
  ],
  'message': ''
}
 */
