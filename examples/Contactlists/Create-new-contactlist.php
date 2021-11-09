<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\Api\Model\NewContactList;
use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Create_new_Contactlist
 */
// new Model Instance
$newContactList = new NewContactList(
    'Internal name of this list',
    'Martin Strouhal',
    'info@youremail.cz', //must be confirmed
    'info@youremail.cz' //must be confirmed
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->create($newContactList);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
  {
  'statusCode': 201,
  'status': 'created',
  'data': {
    'name': 'Internal name of this list',
    'created': '2021-11-09 10:15:11',
    'notification_emailadresses': '[]',
    'alertIn': 0,
    'alertOut': 0,
    'trackedDefaultFields': 'a:0:{}',
    'sendername': 'Martin Strouhal',
    'senderemail': 'info@youremail.cz',
    'replyto': 'info@youremail.cz',
    'hidden': 0,
    'activeContacts': 0,
    'id': 769
  },
  'message': ''
}
 */
