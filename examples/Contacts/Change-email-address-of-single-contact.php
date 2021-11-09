<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contacts-Change_Contacts_e_mail_address
 */
// new Model Instance
$model = new \SmartEmailing\Api\Model\ChangeEmailAddress(
    'original-email@yahoo.com',
    'new-email@yahoo.com'
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contacts()
    ->changeEmailAddress($model);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 201,
  'status': 'created',
  'data': [],
  'message': ''
}
 */
