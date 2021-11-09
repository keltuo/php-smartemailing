<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Update_Contactlist
 */
// new Model Instance
$contactList = new \SmartEmailing\Api\Model\ContactList(
    'Changed name',
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->update(769, $contactList);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'data': {
    'name': 'Changed name',
    'created': '2021-11-09 10:15:11',
    'notification_emailadresses': '[]',
    'alertIn': 0,
    'alertOut': 0,
    'trackedDefaultFields': 'a:0:{}',
    'sendername': 'Martin Strouhal',
    'senderemail': 'info@top-pojisteni.cz',
    'replyto': 'info@top-pojisteni.cz',
    'hidden': 0,
    'activeContacts': 0,
    'id': 769
  },
  'message': ''
}
 */
