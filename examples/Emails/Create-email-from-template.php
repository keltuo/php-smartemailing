<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Emails-Create_e_mail_from_template
 */
// new Model Instance
$template = new \SmartEmailing\Api\Model\EmailTemplate(
    48,
    (new \SmartEmailing\Api\Model\Bag\ReplaceBag())
        ->add(new \SmartEmailing\Api\Model\Replace(
            'product_12_name',
            'Red car'
        ))
        ->add(new \SmartEmailing\Api\Model\Replace(
            'product_12_description',
            'Bright red car is always the best')
        )
);

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->emails()
    ->createFromTemplate($template);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'data': {
    'email_id': 472
  },
  'message': ''
}
 */
