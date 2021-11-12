<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Emails-Create_new_E_mail
 */
// new Model Instance
$newModel = new \SmartEmailing\Api\Model\Email(
    'Hello world, this is Subject!',
    'Internal name of this e-mail, public will not see it',
    '&#x3C;span&#x3E;Hello!&#x3C;/span&#x3E;',
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->emails()
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
    'id': 475,
    'name': 'Hello world, this is Subject!',
    'title': 'Internal name of this e-mail, public will not see it',
    'htmlbody': '\u0026#x3C;span\u0026#x3E;Hello!\u0026#x3C;/span\u0026#x3E;',
    'textbody': '\u003cspan\u003eHello!\u003c/span\u003e',
    'created': '2021-11-12 15:35:46',
    'template': false,
    'attachments': [],
    'custom_message_headers': []
  },
  'message': ''
}
 */
